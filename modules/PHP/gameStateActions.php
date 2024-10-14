<?php

//
use Bga\GameFramework\Actions\Types\StringParam;
use Bga\GameFramework\Actions\Types\IntParam;
use Bga\GameFramework\Actions\Types\JsonParam;

/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
trait gameStateActions
{
	function actFactionChoice(#[StringParam(alphanum: true)] string $faction)
	{
		$player_id = intval(self::getCurrentPlayerId());
//
		if (!in_array($faction, array_keys($this->FACTIONS))) throw new BgaVisibleSystemException("Invalid faction: $faction");
		if (in_array($faction, array_keys(Factions::getAllDatas()))) throw new BgaVisibleSystemException("Faction already exists: $faction");
//
		Factions::create($faction, $player_id);
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('msg', clienttranslate('${player_name} has choosen ${faction}'), ['player_name' => self::getCurrentPlayerName(), 'faction' => $faction]);
		self::notifyAllPlayers('faction', '', ['faction' => $faction, 'player_id' => $player_id]);
//* -------------------------------------------------------------------------------------------------------- */
		$actionCards = [];
		for ($n = 1;
			$n <= 10;
			$n++) $actionCards[] = ['type' => $faction, 'type_arg' => $n, 'nbr' => 1];
		$this->actionCards->createCards($actionCards, $faction);
//
		$this->gamestate->nextState('continue');
	}
	function actSettlementChoice(#[IntParam(min: 0, max: 22)] int $location)
	{
		$player_id = intval(self::getCurrentPlayerId());
//
		if (!array_key_exists($location, Board::REGIONS)) throw new BgaVisibleSystemException("Invalid location: $location");
		if (Board::REGIONS[$location] !== FARMLAND) throw new BgaVisibleSystemException("Location is not FARMLAND: $location");
//
		foreach (Markers::getAt($location) as $id => $marker)
		{
			Markers::destroy($id);
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('removeMarker', '', ['marker' => $marker]);
//* -------------------------------------------------------------------------------------------------------- */
		}
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create(Factions::get($player_id), $location))]);
//* -------------------------------------------------------------------------------------------------------- */
		$this->gamestate->nextState('continue');
	}
	function actPass()
	{
		$player_id = intval(self::getCurrentPlayerId());
		$faction = Factions::getFaction($player_id);
//
		$resources = Tokens::getAt($player_id);
		if ($resources)
		{
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('msg', '<B>${player_name}</B>\'s resources are discarded', ['player_name' => self::getCurrentPlayerName()]);
//* -------------------------------------------------------------------------------------------------------- */
			foreach ($resources as $resource)
			{
				Tokens::destroy($resource['id']);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('removeToken', '', ['token' => $resource]);
//* -------------------------------------------------------------------------------------------------------- */
			}
		}
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('msg', '<B>${player_name}</B>\'s hand is discarded', ['player_name' => self::getCurrentPlayerName()]);
//* -------------------------------------------------------------------------------------------------------- */
		foreach ($this->actionCards->getPlayerHand($player_id) as $card)
		{
			$this->actionCards->moveCard($card['id'], "discard/$faction");
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
		}
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('msg', clienttranslate('<B>${player_name}</B> draws 5 cards'), ['player_name' => self::getCurrentPlayerName()]);
//* -------------------------------------------------------------------------------------------------------- */
		foreach ($this->actionCards->pickCards(5, $faction, $player_id) as $card)
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyPlayer($player_id, 'drawCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
//
		$this->gamestate->nextState('pass');
	}
	function actPlay(#[IntParam] int $id, #[IntParam] int $variant = 0)
	{
		$player_id = intval(self::getCurrentPlayerId());
		$faction = Factions::getFaction($player_id);
//
		$card = $this->actionCards->getCard($id);
		if (!$card) throw new BgaVisibleSystemException("Invalid card: $id");
//
		if (is_numeric($card['type'])) $name = $this->ACTIONSCARDS[($card['type'] - 1) * 8 + $card['type_arg']]['title'];
		else $name = $this->ACTIONSCARDS[$card['type']][$card['type_arg']]['title'];
//
		if (is_numeric($card['type'])) $action = $this->ACTIONSCARDS[($card['type'] - 1) * 8 + $card['type_arg']][$variant];
		else $action = $this->ACTIONSCARDS[$card['type']][$card['type_arg']][$variant];
//
		$matches = [];
		if (preg_match('/^\$\{(FOOD|WOOD|METAL|STONE|CULTURE)\}$/', $action, $matches))
		{
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('msg', '<B>${title}</B> produces ${resource}', ['resource' => $matches[1], 'title' => $name]);
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create($matches[1], $player_id))]);
//* -------------------------------------------------------------------------------------------------------- */
			$this->actionCards->moveCard($id, "discard/$faction");
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
		}
		else if (preg_match('/^\$\{(ATTACK|DEFENSE)\}$/', $action, $matches))
		{
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
		}
		else
		{
			foreach ($this->actionCards->getCardsInLocation('playOnTable', $player_id) as $otherCard)
			{
				if (is_numeric($otherCard['type'])) $otherName = $this->ACTIONSCARDS[($otherCard['type'] - 1) * 8 + $otherCard['type_arg']]['title'];
				else $otherName = $this->ACTIONSCARDS[$otherCard['type']][$otherCard['type_arg']]['title'];
//
				if ($name === $otherName) throw new BgaUserException(_("You can only have one play-on-the-table card with the same title in play at the same time"));
			}
//
			if (preg_match('/^Collect/', $action))
			{
				$this->actionCards->moveCard($id, "playOnTable", $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('msg', '<B>${title}</B> is played on the table', ['title' => $name]);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('playOnTable', '', ['card' => $this->actionCards->getCard($id)]);
//* -------------------------------------------------------------------------------------------------------- */
			}
			else if (preg_match('/^Store/', $action))
			{
				$this->actionCards->moveCard($id, "playOnTable", $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('msg', '<B>${title}</B> is played on the table', ['title' => $name]);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('playOnTable', '', ['card' => $this->actionCards->getCard($id)]);
//* -------------------------------------------------------------------------------------------------------- */
			}
			else throw new BgaVisibleSystemException("NOT IMPLEMENTED");
		}
//
		$this->gamestate->nextState('continue');
	}
	function actEffect(#[IntParam] int $id, #[JsonParam] array $resources = [])
	{
		$player_id = intval(self::getCurrentPlayerId());
		$faction = Factions::getFaction($player_id);
//
		$card = $this->actionCards->getCard($id);
		if (!$card) throw new BgaVisibleSystemException("Invalid card: $id");
//
		if (is_numeric($card['type'])) $actionCard = $this->ACTIONSCARDS[($card['type'] - 1) * 8 + $card['type_arg']];
		else $actionCard = $this->ACTIONSCARDS[$card['type']][$card['type_arg']];
//
		foreach (['FOOD', 'WOOD', 'METAL', 'STONE', 'CULTURE', 'WILD'] as $resource) $toCollect[$resource] = preg_match_all("/\{($resource)\}/", $actionCard[0]);
		foreach (Tokens::getAt("ALTAYcard-$id") as $token) $toCollect[$token['type']]--;
//
		$playerResources = Tokens::getAt($player_id);
		foreach ($resources as $resource)
		{
			if (max($toCollect) === 0) throw new BgaUserException(_("No more room to collect/store resources"));
//
			if ($toCollect[$resource] === 0)
			{
				if ($toCollect['WILD'] === 0) throw new BgaUserException(_("You cannot collect/store that type of resource on this card"));
				$toCollect['WILD']--;
			}
			else $toCollect[$resource]--;
//
			foreach ($playerResources as $index => $playerResource)
			{
				if ($playerResource['type'] === $resource)
				{
					Tokens::destroy($playerResource['id']);
//* -------------------------------------------------------------------------------------------------------- */
					self::notifyAllPlayers('removeToken', '', ['token' => $playerResource]);
//* -------------------------------------------------------------------------------------------------------- */
					self::notifyAllPlayers('msg', '<B>${title}</B> collects/stores ${resource}', ['resource' => $resource, 'title' => $actionCard['title']]);
//* -------------------------------------------------------------------------------------------------------- */
					self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create($resource, "ALTAYcard-$id"))]);
//* -------------------------------------------------------------------------------------------------------- */
					unset($playerResources[$index]);
					break;
				}
			}
			if (max($toCollect) === 0 && preg_match('/^Collect/', $actionCard[0]))
			{
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('msg', '<B>${title}</B> is completed', ['resource' => $resource, 'title' => $actionCard['title']]);
//* -------------------------------------------------------------------------------------------------------- */

				foreach (Tokens::getAt("ALTAYcard-$id") as $resource)
				{
					Tokens::destroy($resource['id']);
//* -------------------------------------------------------------------------------------------------------- */
					self::notifyAllPlayers('removeToken', '', ['token' => $resource]);
//* -------------------------------------------------------------------------------------------------------- */
				}
//
				$this->actionCards->moveCard($card['id'], "discard/$faction");
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//
				$this->globals->set('action', preg_match_all("/\{(SETTLEMENT)\}/", $actionCard[0]));
//
				$this->gamestate->nextState('placeSettlement');
			}
		}
	}
	function actPlaceSettlement(#[IntParam(min: 0, max: 22)] int $location)
	{
		$player_id = intval(self::getCurrentPlayerId());
		$faction = Factions::getFaction($player_id);
//
		if (!in_array($location, Board::settlements($faction))) throw new BgaVisibleSystemException("Invalid location: $location");
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create(Factions::get($player_id), $location))]);
//* -------------------------------------------------------------------------------------------------------- */
		$this->gamestate->nextState('continue');
	}
}
