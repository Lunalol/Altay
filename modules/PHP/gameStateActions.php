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
		if (!in_array($faction, array_keys($this->Factions))) throw new BgaVisibleSystemException("Invalid faction: $faction");
		if (in_array($faction, array_keys(Factions::getAllDatas()))) throw new BgaVisibleSystemException("Faction already exists: $faction");
//
		Factions::create($faction, $player_id);
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('msg', clienttranslate('${player_name} has choosen <B>${faction}</B>'), [
			'player_name' => self::getCurrentPlayerName(),
			'faction' => $this->Factions[$faction], 'i18n' => ['faction']
		]);
//* -------------------------------------------------------------------------------------------------------- */
		foreach ($this->actionCards->getCardsInLocation($faction) as $card)
		{
			$this->actionCards->moveCard($card['id'], 'hand', $player_id);
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyPlayer($player_id, 'getCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
		}
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
		foreach (Markers::getAt($location) as $marker)
		{
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('removeMarker', '', ['marker' => $marker]);
//* -------------------------------------------------------------------------------------------------------- */
		}
//* -------------------------------------------------------------------------------------------------------- */
		self::notifyAllPlayers('placeToken', '', ['token' => Tokens::get(Tokens::create(Factions::get($player_id), $location))]);
//* -------------------------------------------------------------------------------------------------------- */
		$this->gamestate->nextState('continue');
	}
}
