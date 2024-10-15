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
		1 => ['VP' => 0, 'title' => clienttranslate('Colonist'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to fill a Village')]],
		2 => ['VP' => 0, 'title' => clienttranslate('Digger'), 'variants' => ['${METAL}', '${STONE}']],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		4 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		5 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		6 => ['VP' => 0, 'title' => clienttranslate('Village'), 'variants' => [clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}')]],
		7 => ['VP' => 0, 'title' => clienttranslate('Village'), 'variants' => [clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}')]],
		8 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
	],
//
	'ELVENFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		2 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		4 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		5 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		6 => ['VP' => 0, 'title' => clienttranslate('Loremaster'), 'variants' => ['${CULTURE}', clienttranslate('Store ${CULTURE}')]],
		7 => ['VP' => 0, 'title' => clienttranslate('Loremaster'), 'variants' => ['${CULTURE}', clienttranslate('Store ${CULTURE}')]],
		8 => ['VP' => 0, 'title' => clienttranslate('Village'), 'variants' => [clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}')]],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
	],
//
	'FIREFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		2 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		4 => ['VP' => 0, 'title' => clienttranslate('Shaman'), 'variants' => ['${CULTURE}', clienttranslate('Consume a ${CONQUEST} to produce ${WILD}')]],
		5 => ['VP' => 0, 'title' => clienttranslate('Village'), 'variants' => [clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}')]],
		6 => ['VP' => 0, 'title' => clienttranslate('Village'), 'variants' => [clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}')]],
		7 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		8 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
	],
//
	'SMALLFOLK' => [
//
		1 => ['VP' => 0, 'title' => clienttranslate('Craftsman'), 'variants' => ['${WOOD}']],
		2 => ['VP' => 0, 'title' => clienttranslate('Craftsman'), 'variants' => ['${STONE}']],
		3 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		4 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		5 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		6 => ['VP' => 0, 'title' => clienttranslate('Hunter'), 'variants' => ['${FOOD}']],
		7 => ['VP' => 0, 'title' => clienttranslate('Spellweaver'), 'variants' => ['${CULTURE}', clienttranslate('Store ${WILD}')]],
		8 => ['VP' => 0, 'title' => clienttranslate('Village'), 'variants' => [clienttranslate('Collect ${FOOD} ${FOOD} to build ${SETTLEMENT}')]],
		9 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
		10 => ['VP' => 0, 'title' => clienttranslate('Warrior'), 'variants' => ['${ATTACK}', '${DEFENSE}']],
	],
//
	1 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	2 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	3 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	4 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	5 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	6 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	7 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
	8 => ['VP' => 0, 'title' => clienttranslate('Farmer'), 'variants' => ['${FOOD}', clienttranslate('Use a farmland to produce ${FOOD} ${FOOD}')]],
//
	9 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	10 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	11 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	12 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	13 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	14 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	15 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
	16 => ['VP' => 0, 'title' => clienttranslate('Lumberjack'), 'variants' => ['${WOOD}', clienttranslate('Use a forest to produce ${METAL} ${METAL}')]],
//
	17 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	18 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	19 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	20 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	21 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	22 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	23 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
	24 => ['VP' => 0, 'title' => clienttranslate('Miner'), 'variants' => ['${METAL}', clienttranslate('Use a hill to produce ${METAL} ${METAL}')]],
//
	25 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	26 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	27 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	28 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	29 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	30 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	31 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
	32 => ['VP' => 0, 'title' => clienttranslate('STONEcutter'), 'variants' => ['${STONE}', clienttranslate('Use a mountain to produce ${STONE} ${STONE}')]],
//
	33 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	34 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	35 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	36 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	37 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	38 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	39 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
	40 => ['VP' => 0, 'title' => clienttranslate('Scholar'), 'variants' => ['${CULTURE}', clienttranslate('Draw a card')]],
//
	41 => ['VP' => 1, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	42 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	43 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	44 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	45 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	46 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	47 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
	48 => ['VP' => 0, 'title' => clienttranslate('Merchant'), 'variants' => [clienttranslate('Store up to ${WILD} ${WILD}')]],
//
	49 => ['VP' => 1, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	50 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	51 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	52 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	53 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	54 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	55 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
	56 => ['VP' => 0, 'title' => clienttranslate('Cavalry'), 'variants' => ['${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE}']],
//
	57 => ['VP' => 1, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	58 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	59 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	60 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	61 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	62 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	63 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
	64 => ['VP' => 0, 'title' => clienttranslate('Town'), 'variants' => [clienttranslate('Collect ${WOOD} to build ${SETTLEMENT}')]],
//
	65 => ['VP' => 1, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	66 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	67 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	68 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	69 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	70 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	71 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
	72 => ['VP' => 0, 'title' => clienttranslate('Worker'), 'variants' => ['${WOOD}', '${METAL}', '${STONE}']],
//
	73 => ['VP' => 2, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	74 => ['VP' => 1, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	75 => ['VP' => 0, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	76 => ['VP' => 0, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	77 => ['VP' => 0, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	78 => ['VP' => 0, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	79 => ['VP' => 0, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
	80 => ['VP' => 0, 'title' => clienttranslate('Chariot'), 'variants' => ['${ATTACK} ${ATTACK} ${ATTACK}', '${DEFENSE} ${DEFENSE} ${DEFENSE}']],
//
	81 => ['VP' => 2, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	82 => ['VP' => 1, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	83 => ['VP' => 0, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	84 => ['VP' => 0, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	85 => ['VP' => 0, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	86 => ['VP' => 0, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	87 => ['VP' => 0, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
	88 => ['VP' => 0, 'title' => clienttranslate('City'), 'variants' => [clienttranslate('Collect ${FOOD} ${WOOD} to build ${SETTLEMENT} ${SETTLEMENT}')]],
];
