<?php

/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
trait gameStates
{
	function stStartOfGame()
	{
//
// Action decks
//
		foreach (array_keys($this->FACTIONS) as $faction)
		{
			$actionCards = [];
			for ($n = 1; $n <= 10; $n++) $actionCards[] = ['type' => $faction, 'type_arg' => $n, 'nbr' => 1];
			$this->actionCards->createCards($actionCards, $faction);
		}
//
		for ($type = 1; $type <= 11; $type++)
		{
			$actionCards = [];
			for ($n = 0; $n < 2 * self::getPlayersNumber(); $n++) $actionCards[] = ['type' => $type, 'type_arg' => $n, 'nbr' => 1];
			$this->actionCards->createCards($actionCards, "display-$type");
		}
//
// Achievement decks
//
		$this->achievementCards->createCards([
			['type' => 1, 'type_arg' => 1, 'nbr' => self::getPlayersNumber()],
			['type' => 1, 'type_arg' => 2, 'nbr' => self::getPlayersNumber()],
			['type' => 1, 'type_arg' => 3, 'nbr' => self::getPlayersNumber()],
			['type' => 1, 'type_arg' => 4, 'nbr' => self::getPlayersNumber()],
			['type' => 1, 'type_arg' => 5, 'nbr' => self::getPlayersNumber()],
			], 'level-1-deck');
//
		$this->achievementCards->createCards([
			['type' => 2, 'type_arg' => 1, 'nbr' => self::getPlayersNumber()],
			['type' => 2, 'type_arg' => 2, 'nbr' => self::getPlayersNumber()],
			['type' => 2, 'type_arg' => 3, 'nbr' => self::getPlayersNumber()],
			['type' => 2, 'type_arg' => 4, 'nbr' => self::getPlayersNumber()],
			['type' => 2, 'type_arg' => 5, 'nbr' => self::getPlayersNumber()],
			], 'level-2-deck');
//
		$this->achievementCards->createCards([
			['type' => 3, 'type_arg' => 1, 'nbr' => 1],
			['type' => 3, 'type_arg' => 2, 'nbr' => 1],
			['type' => 3, 'type_arg' => 3, 'nbr' => 1],
			['type' => 3, 'type_arg' => 4, 'nbr' => 1],
			['type' => 3, 'type_arg' => 5, 'nbr' => 1],
			['type' => 3, 'type_arg' => 6, 'nbr' => 1],
			['type' => 3, 'type_arg' => 7, 'nbr' => 1],
			['type' => 3, 'type_arg' => 8, 'nbr' => 1],
			['type' => 3, 'type_arg' => 9, 'nbr' => 1],
			['type' => 3, 'type_arg' => 10, 'nbr' => 1],
			], 'level-3-deck');
//
		foreach (['level-1', 'level-2', 'level-3'] as $level)
		{
			$this->achievementCards->shuffle("$level-deck");
//
			$cards = [1 => 0, 2 => 0, 3 => 0];
			while (true)
			{
				$card = $this->achievementCards->getCardOnTop("$level-deck");
				foreach ($cards as $index => $type_arg)
				{
					if ($type_arg === 0 || $type_arg === $card['type_arg'])
					{
						$cards[$index] = $card['type_arg'];
						$this->achievementCards->moveCard($card['id'], $level, $index);
						if ($index === 3) break 2;
						break;
					}
				}
			}
		}
//
// Conquest Marker
//
		$conquestMarkers12 = ['x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x1', 'x2food', 'x2food', 'x2food', 'x2wood', 'x2wood', 'x2wood', 'x2metal', 'x2metal', 'x2metal', 'x2stone', 'x2stone', 'x2stone'];
		$conquestMarkers3 = ['x3wood', 'x3wood', 'x3wood', 'x3metal', 'x3metal', 'x3metal', 'x3stone', 'x3stone', 'x3stone'];
//
		shuffle($conquestMarkers12);
		shuffle($conquestMarkers3);
//
		foreach (Board::REGIONS as $location => $type)
		{
			if ($type === MOUNTAIN) Markers::create(array_pop($conquestMarkers3), $location);
			else Markers::create(array_pop($conquestMarkers12), $location);
		}
//
// Victory point Marker
//
		Markers::create('VP', 18);
		Markers::create('VP', 19);
		Markers::create('VP', 21);
//
		$this->globals->set(FIRSTPLAYER, $this->activeNextPlayer());
		$this->gamestate->nextState('factionChoice');
	}
	function stNextPlayer()
	{
		if ($this->activeNextPlayer() !== $this->globals->get(FIRSTPLAYER)) return $this->gamestate->nextState('factionChoice');
//
		$this->activePrevPlayer();
		$this->gamestate->nextState('settlementChoice');
	}
	function stPreviousPlayer()
	{
		if (intval($this->getActivePlayerId()) !== $this->globals->get(FIRSTPLAYER))
		{
			$this->activePrevPlayer();
			return $this->gamestate->nextState('settlementChoice');
		}
//
		foreach (Factions::getAll() as $faction => $player_id)
		{
			$this->actionCards->shuffle($player_id);
//* -------------------------------------------------------------------------------------------------------- */
			self::notifyAllPlayers('msg', '<B>${faction}</B> draws 5 cards', ['faction' => $this->FACTIONS[$faction], 'i18n' => ['faction']]);
//* -------------------------------------------------------------------------------------------------------- */
			foreach ($this->actionCards->pickCards(5, $player_id, $player_id) as $card)
//* -------------------------------------------------------------------------------------------------------- */
				self::notifyPlayer($player_id, 'drawCard', '', ['card' => $card]);
//* -------------------------------------------------------------------------------------------------------- */
		}
//
		$this->gamestate->nextState('startOfTurn');
	}
	function stStartOfTurn()
	{

	}
}
