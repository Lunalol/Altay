<?php

/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
trait gameStateArguments
{
	function argsFactionChoice()
	{
		return array_values(array_diff(array_keys($this->FACTIONS), array_keys(Factions::getAllDatas())));
	}
	function argsSettlementChoice()
	{
		$farmlands = array_keys(array_filter(Board::REGIONS, function ($type, $location)
			{
				return $type === FARMLAND && $location <= 22;
			}, ARRAY_FILTER_USE_BOTH));
//
		return array_values(array_diff($farmlands, array_column(Tokens::getAllDatas(), 'location')));
	}
	function argsPlaceSettlement()
	{
		$player_id = intval($this->getActivePlayerId());
		$faction = Factions::getFaction($player_id);
//
		return Board::settlements($faction);
	}
}
