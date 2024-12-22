/* global g_gamethemeurl */

function achievementCard(card)
{
	const achievementCard = gameui.gamedatas.ACHIEVEMENTS[card.type][card.type_arg];
//
	const oncePerTurn = achievementCard[0].match(/\$\{ONCEPERTURN\}/);
//
	let html = '';
	html += `<div id='ALTAYachievement-${card.id}' title='${_(achievementCard.title.toUpperCase())}' class='ALTAYachievementCards ${oncePerTurn ? 'ALTAYoncePerTurn' : ''}' data-id='${card.id}' data-type='${card.type}' data-type_arg='${card.type_arg}' style='background-position-x:${card.type_arg * 100 / 10}%'>`;
	html += `<div class='ALTAYachievementCardTitle'>${_(achievementCard.title.toUpperCase())}</div>`;
	html += `<div class='ALTAYachievementCardEffect' style='top:76cqh;bottom:5cqh;left:6cqw;right:18cqw;'>${translate(achievementCard[0])}</div>`;
	html += `</div>`;
	return html;
}
function actionCard(card)
{
	const actionCard = isNaN(card.type) ? gameui.gamedatas.ACTIONCARDS[card.type][card.type_arg] : gameui.gamedatas.ACTIONCARDS[(+card.type - 1) * 8 + +card.type_arg + 1];
//
	const isCombat = (card.type === 'EARTHFOLK' && [8, 9, 10].includes(+card.type_arg))
			|| (card.type === 'ELVENFOLK' && [9, 10].includes(+card.type_arg))
			|| (card.type === 'FIREFOLK' && [7, 8, 9, 10].includes(+card.type_arg))
			|| (card.type === 'SMALLFOLK' && [9, 10].includes(+card.type_arg))
			|| ([7, 10].includes(+card.type));
//
	if (isNaN(card.type))
	{
//
// Initial action cards (4x10)
//
		let html = '';
		html += `<div id='ALTAYcard-${card.id}' title='${_(actionCard.title.toUpperCase())}' class='ALTAYactionCards ALTAYactionCard ${card.type} ${isCombat ? 'ALTAYcombat' : ''}' data-id='${card.id}' data-type='${card.type}' data-type_arg='${card.type_arg}' style='background-position-x:${(+card.type_arg - 1) * 100 / 87}%'>`;
		html += `<div class='ALTAYactionCardTitle'>${_(actionCard.title.toUpperCase())}</div>`;
		if (actionCard.title === 'Colonist') html += `<div class='ALTAYactionCardEffect' style='top:79cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Village') html += `<div class='ALTAYactionCardEffect' style='top:82cqh;bottom:5cqh;left:6cqw;right:6cqw;'>${translate(actionCard.variants[0])}</div>`;
		if (actionCard.title === 'Loremaster') html += `<div class='ALTAYactionCardEffect' style='top:84cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Shaman') html += `<div class='ALTAYactionCardEffect' style='top:79cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Spellweaver') html += `<div class='ALTAYactionCardEffect' style='top:84cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		html += `</div>`;
		return html;
	}
	else
	{
//
// Action cards (8x11)
//
		let html = '';
		html += `<div id='ALTAYcard-${card.id}' title='${_(actionCard.title.toUpperCase())}' class='ALTAYactionCards ALTAYactionCard ${isCombat ? 'ALTAYcombat' : ''}' data-id='${card.id}' data-type='${card.type}' data-type_arg='${card.type_arg}' style='background-position-x:${((+card.type - 1) * 8 + +card.type_arg) * 100 / 87}%'>`;
		html += `<div class='ALTAYactionCardTitle'>${_(actionCard.title.toUpperCase())}</div>`;
		if (actionCard.title === 'Farmer') html += `<div class='ALTAYactionCardEffect' style='top:79cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Lumberjack') html += `<div class='ALTAYactionCardEffect' style='top:79cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Miner') html += `<div class='ALTAYactionCardEffect' style='top:79cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Stonecutter') html += `<div class='ALTAYactionCardEffect' style='top:79cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Scholar') html += `<div class='ALTAYactionCardEffect' style='top:82cqh;bottom:5cqh;left:28cqw;right:6cqw;'>${translate(actionCard.variants[1])}</div>`;
		if (actionCard.title === 'Merchant') html += `<div class='ALTAYactionCardEffect' style='top:84cqh;bottom:5cqh;left:6cqw;right:6cqw;'>${translate(actionCard.variants[0])}</div>`;
		if (actionCard.title === 'Town') html += `<div class='ALTAYactionCardEffect' style='top:83cqh;bottom:5cqh;left:6cqw;right:6cqw;'>${translate(actionCard.variants[0])}</div>`;
		if (actionCard.title === 'City') html += `<div class='ALTAYactionCardEffect' style='top:82cqh;bottom:5cqh;left:6cqw;right:6cqw;'>${translate(actionCard.variants[0])}</div>`;
		html += `</div>`;
		return html;
	}
}
function translate(variant)
{
	return dojo.string.substitute(_(variant), {
		'you': '${you}',
		'FOOD': `<img draggable='false' class='ALTAYresource' data-resource='${_('FOOD')}' draggable='false' src='${g_gamethemeurl}img/SVG/FOOD.svg'>`,
		'WOOD': `<img draggable='false' class='ALTAYresource' data-resource='${_('WOOD')}' draggable='false' src='${g_gamethemeurl}img/SVG/WOOD.svg'>`,
		'METAL': `<img draggable='false' class='ALTAYresource' data-resource='${_('METAL')}' draggable='false' src='${g_gamethemeurl}img/SVG/METAL.svg'>`,
		'STONE': `<img draggable='false' class='ALTAYresource' data-resource='${_('STONE')}' draggable='false' src='${g_gamethemeurl}img/SVG/STONE.svg'>`,
		'CULTURE': `<img draggable='false' class='ALTAYresource' data-resource='${_('CULTURE')}' draggable='false' src='${g_gamethemeurl}img/SVG/CULTURE.svg'>`,
		'SETTLEMENT': `<img draggable='false' class='ALTAYresource' draggable='false' src='${g_gamethemeurl}img/SVG/SETTLEMENT.svg'>`,
		'ATTACK': `<img draggable='false' class='ALTAYicon' data-icon='${_('ATTACK')}' draggable='false' src='${g_gamethemeurl}img/SVG/ATTACK.svg'>`,
		'DEFENSE': `<img draggable='false' class='ALTAYicon' data-icon='${_('DEFENSE')}' draggable='false' src='${g_gamethemeurl}img/SVG/DEFENSE.svg'>`,
		'WILD': `<img draggable='false' class='ALTAYicon' data-icon='${_('ANY RESOURCE')}'draggable='false' src='${g_gamethemeurl}img/SVG/WILD.svg'>`,
		'CONQUEST': `<img draggable='false' class='ALTAYicon' data-icon='${_('CONQUEST MARKER')} 'draggable='false' src='${g_gamethemeurl}img/SVG/CONQUEST.svg'>`,
		'INSTANT': `<img draggable='false' class='ALTAYicon' draggable='false' src='${g_gamethemeurl}img/SVG/INSTANT.svg'>`,
		'CONTINUOUS': `<img draggable='false' class='ALTAYicon' draggable='false' src='${g_gamethemeurl}img/SVG/CONTINUOUS.svg'>`,
		'ONCEPERTURN': `<img draggable='false' class='ALTAYicon' draggable='false' src='${g_gamethemeurl}img/SVG/ONCEPERTURN.svg'>`,
		'ENDOFTURN': `<img draggable='false' class='ALTAYicon' draggable='false' src='${g_gamethemeurl}img/SVG/ENDOFTURN.svg'>`
	});
}