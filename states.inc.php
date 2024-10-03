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
		'description' => 'Start of game',
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
		'transitions' => ['settlementChoice' => 30, 'startOfGame' => 100]
	],
	99 => [
		'name' => 'gameEnd',
		'description' => clienttranslate('End of game'),
		'type' => 'manager',
		'action' => 'stGameEnd',
		'args' => 'argGameEnd'
	],
];
