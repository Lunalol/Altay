<?php
/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
$machinestates = [
	1 => [
		'name' => 'gameSetup',
		'description' => '',
		'type' => 'manager',
		'action' => 'stGameSetup',
		'transitions' => ['' => 10]
	],
	10 => [
		'name' => 'startOfGame',
		'description' => 'Game setup',
		'type' => 'game',
		'action' => 'stStartOfGame',
		'transitions' => ['factionChoice' => 20]
	],
	20 => [
		'name' => 'factionChoice',
		'description' => clienttranslate('${actplayer} must choose a faction'),
		'descriptionmyturn' => clienttranslate('${you} must choose a faction'),
		'type' => 'activeplayer',
		'args' => 'argsFactionChoice',
		'possibleactions' => ['actFactionChoice'],
		'transitions' => ['continue' => 25]
	],
	25 => [
		'name' => 'nextPlayer',
		'type' => 'game',
		'action' => 'stNextPlayer',
		'transitions' => ['factionChoice' => 20, 'settlementChoice' => 30]
	],
	30 => [
		'name' => 'settlementChoice',
		'description' => clienttranslate('${actplayer} must choose one of the farmland territories'),
		'descriptionmyturn' => clienttranslate('${you} must choose one of the farmland territories'),
		'type' => 'activeplayer',
		'args' => 'argsSettlementChoice',
		'possibleactions' => ['actSettlementChoice'],
		'transitions' => ['continue' => 35]
	],
	35 => [
		'name' => 'previousPlayer',
		'type' => 'game',
		'action' => 'stPreviousPlayer',
		'transitions' => ['settlementChoice' => 30, 'startOfTurn' => 100]
	],
	99 => [
		'name' => 'gameEnd',
		'description' => clienttranslate('End of game'),
		'type' => 'manager',
		'action' => 'stGameEnd',
		'args' => 'argGameEnd'
	],
	100 => [
		'name' => 'startOfTurn',
		'type' => 'game',
		'action' => 'stStartOfTurn',
		'transitions' => ['gameTurn' => 110]
	],
	110 => [
		'name' => 'gameTurn',
		'description' => clienttranslate('${actplayer} must play cards in hand'),
		'descriptionmyturn' => clienttranslate('${you} must play cards in hand'),
		'type' => 'activeplayer',
		'possibleactions' => ['actPlay', 'actEffect', 'actPass'],
		'transitions' => ['continue' => 110, 'placeSettlement' => 120, 'pass' => 190]
	],
	120 => [
		'name' => 'placeSettlement',
		'description' => clienttranslate('${actplayer} must place a settlement'),
		'descriptionmyturn' => clienttranslate('${you} must place a settlement'),
		'type' => 'activeplayer',
		'args' => 'argsPlaceSettlement',
		'possibleactions' => ['actPlaceSettlement'],
		'transitions' => ['continue' => 110]
	],
	190 => [
		'name' => 'endOfTurn',
		'type' => 'game',
		'action' => 'stEndOfTurn',
		'transitions' => ['startOfTurn' => 100]
	],
];
