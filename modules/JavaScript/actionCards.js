function actionCard(card)
{
	if (isNaN(card.type))
	{
//
// Initial action cards (4x10)
//
		return `<div id='ALTAYcard-${card.id}' class='ALTAYactionCards ALTAYactionCard ${card.type}' style='background-position-x:${(+card.type_arg - 1) * 100 / 87}%'></div>`;
	}
	else
	{
//
// Action cards (8x11)
//
		return `<div id='ALTAYcard-${card.id}' class='ALTAYactionCards ALTAYactionCard ' style='background-position-x:${((card.type - 1) * 8 + +card.type_arg) * 100 / 87}%'></div>`;
	}
}

