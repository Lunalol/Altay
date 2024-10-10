<?php

//
use \Bga\GameFramework\Actions\Types\StringParam;
use \Bga\GameFramework\Actions\Types\IntParam;

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
		self::notifyAllPlayers('msg', clienttranslate('${player_name} has choosen <B>${faction}</B>'), [
			'player_name' => self::getCurrentPlayerName(),
			'faction' => $this->FACTIONS[$faction], 'i18n' => ['faction']
		]);
//* -------------------------------------------------------------------------------------------------------- */
		$this->actionCards->moveAllCardsInLocation($faction, $player_id);
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
	function actPlay(#[IntParam] int $id, #[IntParam] int $variant = 0)
	{
		$player_id = intval(self::getCurrentPlayerId());
//
		$card = $this->actionCards->getCard($id);
		if (!$card) throw new BgaVisibleSystemException("Invalid card: $id");
//
		if (is_numeric($card['type'])) $action = $this->ACTIONSCARDS[($card['type'] - 1) * 8 + $card['type_arg']][$variant];
		else $action = $this->ACTIONSCARDS[$card['type']][$card['type_arg']][$variant];
//
		switch ($action)
		{
			case '${food}':
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create('FOOD', $player_id))]);
				$this->actionCards->moveCard($id, 'discard', $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				break;
//
			case '${wood}':
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create('WOOD', $player_id))]);
				$this->actionCards->moveCard($id, 'discard', $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				break;
//
			case '${metal}':
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create('METAL', $player_id))]);
				$this->actionCards->moveCard($id, 'discard', $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				break;
//
			case '${stone}':
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create('STONE', $player_id))]);
				$this->actionCards->moveCard($id, 'discard', $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				break;
//
			case '${culture}':
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create('CULTURE', $player_id))]);
				$this->actionCards->moveCard($id, 'discard', $player_id);
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
				break;
//
			default:
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyAllPlayers('discardCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
		}
//
		$this->gamestate->nextState('continue');
	}
}
