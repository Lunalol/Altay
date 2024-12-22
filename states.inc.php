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
		'action' => 'stSettlementChoice',
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
		'transitions' => ['gameTurn' => 110, 'scoringAndWinner' => 200]
	],
	110 => [
		'name' => 'gameTurn',
		'description' => clienttranslate('${actplayer} must play cards in hand'),
		'descriptionmyturn' => '',
		'type' => 'activeplayer',
		'args' => 'argsGameTurn',
		'possibleactions' => ['actPlay', 'actArchived', 'actAcquireCard', 'actCombat', 'actAchievement', 'actAchievementEffect', 'actEffect', 'actDevelopAchievement', 'actPass', 'actUndo'],
		'transitions' => ['continue' => 110, 'placeSettlement' => 120, 'PVP' => 130, 'endOfTurn' => 180, 'pass' => 190]
	],
	120 => [
		'name' => 'placeSettlement',
		'description' => clienttranslate('${actplayer} must place a settlement'),
		'descriptionmyturn' => clienttranslate('${you} must place a settlement'),
		'type' => 'activeplayer',
		'args' => 'argsPlaceSettlement',
		'action' => 'stPlaceSettlement',
		'possibleactions' => ['actPlaceSettlement'],
		'transitions' => ['placeSettlement' => 120, 'continue' => 110]
	],
	130 => [
		'name' => 'PVP',
		'type' => 'game',
		'action' => 'stPVP',
		'transitions' => ['surrenderOrFight' => 135]
	],
	135 => [
		'name' => 'surrenderOrFight',
		'description' => clienttranslate('${actplayer} must decide to surrender or fight'),
		'descriptionmyturn' => clienttranslate('${you} must decide to surrender or fight'),
		'type' => 'multipleactiveplayer',
		'args' => 'argsSurrenderOrFight',
		'possibleactions' => ['actSurrenderOrFight'],
		'transitions' => ['continue' => 110]
	],
	180 => [
		'name' => 'endOfTurn',
		'description' => clienttranslate('${actplayer} can archive one card on <B>Writing</B>'),
		'descriptionmyturn' => clienttranslate('${actplayer} can archive one card <B>Writing</B>'),
		'type' => 'activeplayer',
		'possibleactions' => ['actEndOfTurn'],
		'transitions' => ['continue' => 190]
	],
	190 => [
		'name' => 'endOfTurn',
		'type' => 'game',
		'action' => 'stEndOfTurn',
		'transitions' => ['startOfTurn' => 100]
	],
	200 => [
		'name' => 'scoringAndWinner',
		'type' => 'game',
		'action' => 'stScoringAndWinner',
		'transitions' => ['gameEnd' => 99]
	],
];
