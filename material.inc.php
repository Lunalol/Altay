<?php
//
$this->FACTIONS = [
	'EARTHFOLK' => clienttranslate('Earthfolk'),
	'ELVENFOLK' => clienttranslate('Elvenfolk'),
	'FIREFOLK' => clienttranslate('Firefolk'),
	'SMALLFOLK' => clienttranslate('Smallfolk'),
];
//
$this->ACTIONSCARDS = [
//
	'EARTHFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Colonist'), '${FOOD}', clienttranslate('Use a farmland to fill a Village'), null],
		2 => ['VP' => 0, 'title' => clienttranslate('Digger'), '${METAL}', '${STONE}', null],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		4 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		5 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		6 => ['VP' => 0, 'title' => clienttranslate('Village'), 'collect' => ['FOOD', 'FOOD'], clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}'), null, null],
		7 => ['VP' => 0, 'title' => clienttranslate('Village'), 'collect' => ['FOOD', 'FOOD'], clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}'), null, null],
		8 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
	],
//
	'ELVENFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		2 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		4 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		5 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		6 => ['VP' => 0, 'title' => clienttranslate('Loremaster'), 'collect' => ['CULTURE'], '${CULTURE}', clienttranslate('Store ${CULTURE}'), null],
		7 => ['VP' => 0, 'title' => clienttranslate('Loremaster'), 'collect' => ['CULTURE'], '${CULTURE}', clienttranslate('Store ${CULTURE}'), null],
		8 => ['VP' => 0, 'title' => clienttranslate('Village'), 'collect' => ['FOOD', 'FOOD'], clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}'), null, null],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
	],
//
	'FIREFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		2 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		4 => ['VP' => 0, 'title' => clienttranslate('Shaman'), '${CULTURE}', clienttranslate('Consume a [conquest-marker] to produce ${WILD}'), null],
		5 => ['VP' => 0, 'title' => clienttranslate('Village'), 'collect' => ['FOOD', 'FOOD'], clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}'), null, null],
		6 => ['VP' => 0, 'title' => clienttranslate('Village'), 'collect' => ['FOOD', 'FOOD'], clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}'), null, null],
		7 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		8 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
	],
//
	'SMALLFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Craftsman'), '${WOOD}', null, null],
		2 => ['VP' => 0, 'title' => clienttranslate('Craftsman'), '${STONE}', null, null],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		4 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		5 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		6 => ['VP' => 0, 'title' => clienttranslate('Hunter'), '${FOOD}', null, null],
		7 => ['VP' => 0, 'title' => clienttranslate('Spellweaver'), 'collect' => ['WILD'], '${CULTURE}', clienttranslate('Store ${WILD}'), null],
		8 => ['VP' => 0, 'title' => clienttranslate('Village'), 'collect' => ['FOOD', 'FOOD'], clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}'), null, null],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), '${ATTACK}', '${DEFENSE}', null],
	],
//
	1 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	2 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	3 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	4 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	5 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	6 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	7 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
	8 => ['VP' => 0, 'title' => clienttranslate('Farmer'), '${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}'), null],
//
	9 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	10 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	11 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	12 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	13 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	14 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	15 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
	16 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), '${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}'), null],
//
	17 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	18 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	19 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	20 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	21 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	22 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	23 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
	24 => ['VP' => 0, 'title' => clienttranslate('Miner'), '${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}'), null],
//
	25 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	26 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	27 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	28 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	29 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	30 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	31 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
	32 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), '${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}'), null],
//
	33 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	34 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	35 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	36 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	37 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	38 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	39 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
	40 => ['VP' => 0, 'title' => clienttranslate('Scholar'), '${CULTURE}', clienttranslate('Draw a card'), null],
//
	41 => ['VP' => 1, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	42 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	43 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	44 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	45 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	46 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	47 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
	48 => ['VP' => 0, 'title' => clienttranslate('Merchant'), clienttranslate('Store up to ${WILD} ${WILD}'), null, null],
//
	49 => ['VP' => 1, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	50 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	51 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	52 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	53 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	54 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	55 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
	56 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), '${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE}', null],
//
	57 => ['VP' => 1, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	58 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	59 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	60 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	61 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	62 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	63 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
	64 => ['VP' => 0, 'title' => clienttranslate('Town'), clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}'), null, null],
//
	65 => ['VP' => 1, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	66 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	67 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	68 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	69 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	70 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	71 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
	72 => ['VP' => 0, 'title' => clienttranslate('Worker'), '${WOOD}', '${METAL}', '${STONE}'],
//
	73 => ['VP' => 2, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	74 => ['VP' => 1, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	75 => ['VP' => 0, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	76 => ['VP' => 0, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	77 => ['VP' => 0, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	78 => ['VP' => 0, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	79 => ['VP' => 0, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
	80 => ['VP' => 0, 'title' => clienttranslate('Chariot'), '${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE] ${DEFENSE} ${DEFENSE}', null],
//
	81 => ['VP' => 2, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	82 => ['VP' => 1, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	83 => ['VP' => 0, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	84 => ['VP' => 0, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	85 => ['VP' => 0, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	86 => ['VP' => 0, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	87 => ['VP' => 0, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
	88 => ['VP' => 0, 'title' => clienttranslate('City'), clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT] ${SETTLEMENT}'), null, null],
];
