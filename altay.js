/* global g_gamethemeurl, ebg, _, dijit */

//
// Game preferences
//
const SPEED = 100;
const AUTO = 101;
const COST = 102;
//
// Animation speeds
//
const SLOW = 0;
const NORMAL = 1;
const FAST = 2;
//
const DELAYS = {[SLOW]: 1000, [NORMAL]: 500, [FAST]: 250};
const COLORS = {ELVENFOLK: '#47a34b', EARTHFOLK: '#ebb41b', SMALLFOLK: '#00a7d2', FIREFOLK: '#e12129'};
const SORT = {FOOD: 0, WOOD: 1, METAL: 2, STONE: 3, CULTURE: 4};
//
define(["dojo", "dojo/_base/declare", "ebg/core/gamegui", "ebg/counter",
	g_gamethemeurl + "modules/JavaScript/constants.js",
	g_gamethemeurl + "modules/JavaScript/cards.js"
], function (dojo, declare)
{
	return declare("bgagame.altay", ebg.core.gamegui,
	{
		constructor: function ()
		{
			console.log('altay constructor');
		},
		setup: function (gamedatas)
		{
			dojo.query('.ALTAYfactionDisplay').remove();
			dojo.query('.ALTAYresourceContainer').remove();
//
			console.log("Starting game setup", gamedatas);
//
// Animations Speed
//
			DELAY = DELAYS[this.getGameUserPreference(SPEED)];
			document.documentElement.style.setProperty('--DELAY', DELAY);
//
// Translations
//
			this.FACTIONS = {
				ELVENFOLK: _('In the forests, danced the <B>Elvenfolk</B>'),
				EARTHFOLK: _('In the deep caves, there dweit the <B>Earthfolk</B>'),
				SMALLFOLK: _('By the shore, dancing with the crashing waves, there lived the <B>SmallFolk</B>'),
				FIREFOLK: _('Beyond the Land, on the other side of the fire, there raged the <B>Firefolk</B>')
			};
			this.REGIONS = {
				0: `<span style='background-color:green;color:white;'>${_('a <B>farmland</B>')}</span>`,
				1: `<span style='background-color:brown;color:white;'>${_('a <B>forest</B>')}</span>`,
				2: `<span style='background-color:black;color:white;'>${_('a <B>hill</B>')}</span>`,
				3: `<span style='background-color:gray;color:white;'>${_('a <B>mountain</B>')}</span>`
			};
//
// Tooltips
//
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYfaction.EARTHFOLK", showDelay: 500, hideDelay: 0, getContent: () => _('EARTHFOLK')});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYfaction.ELVENFOLK", showDelay: 500, hideDelay: 0, getContent: () => _('ELVENFOLK')});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYfaction.FIREFOLK", showDelay: 500, hideDelay: 0, getContent: () => _('FIREFOLK')});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYfaction.SMALLFOLK", showDelay: 500, hideDelay: 0, getContent: () => _('SMALLFOLK')});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYconquestMarker", showDelay: 500, hideDelay: 0, getContent: (node) => _('Conquest marker')});
			new dijit.Tooltip({connectId: "ebd-body", selector: ":not(.ALTAYsettlementMarkerContainer)>.ALTAYsettlement", showDelay: 500, hideDelay: 0, getContent: () => _('Settlement')});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYresource", showDelay: 500, hideDelay: 0, getContent: (node) => _(node.dataset.resource)});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYicon", showDelay: 500, hideDelay: 0, getContent: (node) => _(node.dataset.icon)});
			new dijit.Tooltip({connectId: "ebd-body", selector: ":not(#ALTAYplayerHand)>.ALTAYactionCard", showDelay: 500, hideDelay: 0, getContent: (node) => actionCard({id: 0, type: node.dataset.type, type_arg: node.dataset.type_arg})});
			new dijit.Tooltip({connectId: "ebd-body", selector: ".ALTAYachievementCards", showDelay: 500, hideDelay: 0, getContent: (node) => achievementCard({id: 0, type: node.dataset.type, type_arg: node.dataset.type_arg})});
//
// Player panels
//
			for (let player_id in gamedatas.players)
			{
//				const node = this.getPlayerPanelElement(player_id);
				const node = `player_board_${player_id}`;
//
				dojo.place(`
<div id='ALTAYfactionDisplay-${player_id}' class='ALTAYfactionDisplay' style="display:inline-flex;align-items:center;">
	<div id="ALTAYplayerDeck-${player_id}" class='ALTAYplayer'">
		<img draggable="false" style="height:25px;vertical-align:middle;" src="${g_gamethemeurl}img/SVG/deck.svg">
		<span id="ALTAYplayerDeck-${player_id}-value" style="margin:0px 5px;">?</span>
	</div>
	<div id="ALTAYplayerHand-${player_id}" class='ALTAYplayer'">
		<img draggable="false" style="height:25px;vertical-align:middle;" src="${g_gamethemeurl}img/SVG/hand.svg">
		<span id="ALTAYplayerHand-${player_id}-value" style="margin:0px 0px;">?</span>
	</div>
	<div id="ALTAYplayerDiscard-${player_id}" class='ALTAYplayer'">
		<img draggable="false" style="height:25px;vertical-align:middle;filter:invert(50%);" src="${g_gamethemeurl}img/SVG/deck.svg">
		<span id="ALTAYplayerDiscard-${player_id}-value" style="margin:0px 0px;">?</span>
	</div>
</div>`, node);
//
				this.addTooltipHtml(`ALTAYplayerDeck-${player_id}`, _('Cards in deck'));
				this.addTooltipHtml(`ALTAYplayerHand-${player_id}`, _('Cards in player hand'));
				this.addTooltipHtml(`ALTAYplayerDiscard-${player_id}`, _('Cards in discard pile'));
//
				dojo.place(`<div id='ALTAYsettlementMarkerContainer-${player_id}' class='ALTAYsettlementMarkerContainer' data-faction=''></div>`, node);
				dojo.place(`<div id='ALTAYconquestMarkerContainer-${player_id}' class='ALTAYconquestMarkerContainer'></div>`, node);
				dojo.place(`<div id='ALTAYresources-${player_id}' class='ALTAYresources'></div>`, node);
				dojo.place(`<div id='ALTAYplayOnTable-${player_id}' class='ALTAYplayOnTable'></div>`, node);
				dojo.place(`<div id='ALTAYachievement-${player_id}' class='ALTAYplayOnTable'></div>`, node);
//
			}
			new dijit.Tooltip({connectId: "player_boards", selector: ".ALTAYsettlementMarkerContainer", showDelay: 500, hideDelay: 0, getContent: (node) => dojo.string.substitute(_('${settlement} settlement(s) remaining'), {settlement: dojo.query(`.ALTAYsettlement[data-type='${node.dataset.type}']`, node).length})});
//
			for (let [faction, player_id] of Object.entries(gamedatas.factions))
				this.faction(faction, player_id, gamedatas.cards[`discard/${faction}`] ?? 0, gamedatas.hands[player_id] ?? 0, gamedatas.cards[faction] ?? 0);
//
// Board
//
			this.board = $('ALTAYboard');
			if (gamedatas.setup === 2) dojo.addClass(this.board, 'ALTAY2players');
			if (gamedatas.setup === 3) dojo.addClass(this.board, 'ALTAY3players');
//
			for (let [location, [X, Y]] of Object.entries(BOARD))
			{
				const node = dojo.place(`<div id='ALTAYregion-${location}' class='ALTAYregion' data-id='${location}' tabindex='0'></div>`, this.board);
				dojo.style(node, {position: 'absolute', left: `${X - 10}%`, top: `${Y - 12.5}%`});
				dojo.connect(node, 'click', (event) =>
				{
					dojo.stopEvent(event);
					if (this.isCurrentPlayerActive())
					{
						switch (this.gamedatas.gamestate.name)
						{
							case 'settlementChoice':
								return this.bgaPerformAction('actSettlementChoice', {location: location})
										.then(() => dojo.query('.ALTAYselectable').removeClass('ALTAYselectable'))
										.catch((e) => console.log(e));
							case 'placeSettlement':
								return this.bgaPerformAction('actPlaceSettlement', {location: location})
										.then(() => dojo.query('.ALTAYselectable').removeClass('ALTAYselectable'))
										.catch((e) => console.log(e));
							case 'combat':
								if (location in this.gamedatas.gamestate.args.combatLocations)
								{
									dojo.query('.ALTAYregion.ALTAYselectable', this.board).removeClass('ALTAYselectable');
									dojo.addClass(node, 'ALTAYselectable ALTAYselected');
									for (let l of this.gamedatas.gamestate.args.combatLocations[location]) dojo.addClass(`ALTAYregion-${l}`, 'ALTAYselectable');
								}
								else
								{
									const locations = dojo.query('.ALTAYregion.ALTAYselected', this.board);
									const nodes = dojo.query('.ALTAYactionCard.ALTAYselected', this.playerHand);
									if (nodes.length > 0 && locations.length === 1)
										return this.bgaPerformAction('actCombat', {
											from: locations[0].dataset.id,
											to: node.dataset.id,
											cards: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
												.then(() => dojo.query('.ALTAYselectable').removeClass('ALTAYselectable'))
												.catch((e) => console.log(e));
								}
						}
					}
				});
			}
//
// Play-on-table
//
			for (let card of Object.values(gamedatas.playOnTable)) this.playOnTable(card);
			for (let achievementCard of Object.values(gamedatas.achievementCards.playOnTable)) this.developAchievement(achievementCard);
//
// Markers & Resources & Settlements
//
			for (let marker of Object.values(gamedatas.markers)) this.placeMarker(marker);
			for (let resource of Object.values(gamedatas.resources)) this.placeResource(resource);
			for (let settlement of Object.values(gamedatas.settlements)) this.placeSettlement(settlement);
//
// Achievement decks
//
			for (let level of [1, 2, 3])
			{
				const achievementCards = gamedatas.achievementCards[level];
//
				dojo.place(`<div class='ALTAYachievementCards' data-type='${level}' style='grid-row:level-${level};grid-column:level;'></div>`, 'ALTAYachievementCardDisplay');
//
				dojo.place(`<div id='ALTAYachievementCard-${level}-1' class='ALTAYachievementCardHolder' style='grid-row:level-${level};grid-column:cards 1;'></div>`, 'ALTAYachievementCardDisplay');
				dojo.place(`<div id='ALTAYachievementCard-${level}-2' class='ALTAYachievementCardHolder' style='grid-row:level-${level};grid-column:cards 2;'></div>`, 'ALTAYachievementCardDisplay');
				dojo.place(`<div id='ALTAYachievementCard-${level}-3' class='ALTAYachievementCardHolder' style='grid-row:level-${level};grid-column:cards 3;'></div>`, 'ALTAYachievementCardDisplay');
//
				for (let card of Object.values(achievementCards)) this.placeAchievement(card);
			}
//
// Action decks
//
			for (let [type, actionCards] of Object.entries(gamedatas.actionCards))
			{
				const node = dojo.place(`<div class='ALTAYactionCardHolder'></div>`, 'ALTAYactionCardDisplay');
				for (let card of actionCards) dojo.place(actionCard(card), node, 'first');
				dojo.connect(node, 'click', (event) => {
					dojo.stopEvent(event);
					if (this.isCurrentPlayerActive() && dojo.query('.ALTAYactionCard', node).length > 0)
					{
						const nodes = dojo.query('.ALTAYresource.ALTAYselected', `ALTAYresources-${this.player_id}`);
						if (nodes.length === 0)
						{
							if (this.getGameUserPreference(COST)) this.bgaPerformAction('actAcquireCard', {type: type})
										.then(() => nodes.removeClass('ALTAYselected'))
										.catch((e) => console.log(e));
						}
						else this.bgaPerformAction('actAcquireCard', {type: type, resources: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
									.then(() => nodes.removeClass('ALTAYselected'))
									.catch((e) => console.log(e));
					}
				});
			}
//
// Player hand
//
			this.playerHand = $('ALTAYplayerHand');
			for (let card of Object.values(gamedatas.hand)) this.placeCard(card);
//
			dojo.place(`<div id='ALTAYresourceContainer' class='ALTAYresourceContainer'></div>`, 'page-title');
//
			dojo.connect($('ALTAYplayArea'), 'click', () => {
				if (this.isInterfaceUnlocked()) this.restoreServerGameState();
			});
//
			this.setupNotifications();
//
			console.log("Ending game setup");
		},
		onEnteringState: function (stateName, state)
		{
			console.log('Entering state: ' + stateName, state.args);
//
			dojo.query('.ALTAYresource', `ALTAYresources-${this.player_id}`).forEach((node) =>
				dojo.connect(dojo.place(`<img draggable='false' class='ALTAYresource' data-id='${node.dataset.id}' data-resource='${node.dataset.resource}' draggable='false' src='${g_gamethemeurl}img/SVG/${node.dataset.resource}.svg'>`, 'ALTAYresourceContainer'), 'click', (event) =>
				{
					dojo.stopEvent(event);
					if (this.isCurrentPlayerActive()) dojo.query(`.ALTAYresource[data-id='${node.dataset.id}'`).toggleClass('ALTAYselected');
				}));
//
			switch (stateName)
			{
				case 'gameTurn':
//
					{
						if (this.isCurrentPlayerActive())
						{
							dojo.query('.ALTAYactionCards,.ALTAYachievementCards', `player_board_${this.player_id}`).addClass('ALTAYselectable');
//
							if (this.getGameUserPreference(AUTO))
							{
								for (let card of Object.values(state.args.hand))
								{
									const node = $(`ALTAYcard-${card.id}`);
									if (node)
									{
										if (card.type === 'EARTHFOLK' && [3, 4, 5].includes(+card.type_arg)) return node.click();
										if (card.type === 'ELVENFOLK' && [1, 2, 3, 4, 5].includes(+card.type_arg)) return node.click();
										if (card.type === 'FIREFOLK' && [1, 2, 3].includes(+card.type_arg)) return node.click();
										if (card.type === 'SMALLFOLK' && [1, 2, 3, 4, 5, 6].includes(+card.type_arg)) return node.click();
										if ([1, 2, 3, 4].includes(+node.dataset.type)) return node.click();
									}
								}
							}
						}
					}
					break;
//
				case 'surrenderOrFight':
				case 'surrender':
				case 'fight':
//
					{
						dojo.addClass(`ALTAYregion-${state.args.from}`, 'ALTAYselectable ALTAYselected');
						dojo.addClass(`ALTAYregion-${state.args.to}`, 'ALTAYselectable ALTAYselected');
//
						dojo.empty('ALTAYresourceContainer');
//
						const attacker = dojo.query(`.ALTAYsettlement[data-location='${state.args.from}']`, this.board);
						attacker.forEach((node) => dojo.place(`<div class='ALTAYsettlement' tabindex='0' data-type='${node.dataset.type}'></div>`, 'ALTAYresourceContainer'));
//
						for (let i = 0; i < state.args.attack; i++)
							dojo.place(translate('${ATTACK}'), 'ALTAYresourceContainer');
//
						dojo.place(`<div style='margin:0px 20px;'>${_('VS')}</div>`, 'ALTAYresourceContainer');
//
						const defender = dojo.query(`.ALTAYsettlement[data-location='${state.args.to}']`, this.board);
						defender.forEach((node) => dojo.place(`<div class='ALTAYsettlement' tabindex='0' data-type='${node.dataset.type}'></div>`, 'ALTAYresourceContainer'));
					}
					break;
			}
		},
		onLeavingState: function (stateName)
		{
			console.log('Leaving state: ' + stateName);
//
			if (this.isCurrentPlayerActive())
			{
				if ('args' in this.gamedatas.gamestate && 'card' in this.gamedatas.gamestate.args)
				{
					const node = $(`ALTAYcard-${this.gamedatas.gamestate.args.card.id}`);
					if (node && node.parentNode === this.board)
					{
						dojo.destroy(node);
						this.placeCard(this.gamedatas.gamestate.args.card);
					}
				}
			}
//
			dojo.query('.ALTAYselectable').removeClass('ALTAYselectable');
			dojo.query('.ALTAYselected').removeClass('ALTAYselected');
			dojo.query('.ALTAYdisabled').removeClass('ALTAYdisabled');
//
			dojo.empty('ALTAYresourceContainer');
		}
		,
		onUpdateActionButtons: function (stateName, args)
		{
			console.log('onUpdateActionButtons: ' + stateName, args);
//
			if (this.gamedatas.lastTurn && !$('ALTAYlastTurn')) dojo.place(`<div id='ALTAYlastTurn' style='background:red;border-radius:5px;'>${_('Last turn')}</div>`, 'maintitlebar_content', 'first');
//
			if (this.isCurrentPlayerActive())
			{
				switch (stateName)
				{
//
					case 'factionChoice':
//
						{
							dialog = new ebg.popindialog();
							dialog.create('ALTAYfactionChoice');
							dialog.setTitle($('pagemaintitletext').innerHTML);
//
							let html = `<div style='display:flex;flex-direction:column;'>`;
							for (let faction of args)
							{
								html += `<div class='ALTAYactionDisplay' style='display:flex;flex-direction:row;align-items:center;margin:10px;'>`;
								html += `<a id='${faction}button' class='bgabutton bgabutton_fixedwidth' style='color:black;background:${COLORS[faction]};margin-right:25px;white-space:normal;font-weight:normal;'>${_(this.FACTIONS[faction])}</a>`;
								for (let card = 1; card <= 10; card++) html += actionCard({id: 0, type: faction, type_arg: card});
								html += `</div>`;
							}
							html += `</div>`;
//
							dialog.setContent(html);
							dialog.hideCloseIcon();
							dialog.show();
							dojo.style('popin_ALTAYfactionChoice', 'position', 'fixed');
							dojo.style('popin_ALTAYfactionChoice_underlay', 'visibility', 'hidden');
//
							for (let faction of args)
							{
								dojo.connect($(`${faction}button`), 'click', (event) =>
								{
									dojo.stopEvent(event);
									return this.bgaPerformAction('actFactionChoice', {faction: faction})
											.then(() => dialog.destroy())
											.catch((e) => console.log(e));
								});
							}
						}
						break;
//
					case 'settlementChoice':
//
						{
							dojo.query('.ALTAYmarker', this.board).addClass('ALTAYdisabled');
							for (let location of args) dojo.addClass(`ALTAYregion-${location}`, 'ALTAYselectable');
						}
						break;
//
					case 'placeSettlement':
//
						{
							dojo.query('.ALTAYmarker', this.board).addClass('ALTAYdisabled');
							for (let location of args) dojo.addClass(`ALTAYregion-${location}`, 'ALTAYselectable');
						}
						break;
//
					case 'combat':
//
						{
							dojo.addClass('ALTAYplayerHand', 'ALTAYselected');
							$(this.board).scrollIntoView({behavior: 'smooth', block: 'center'});
//
							dojo.query('.ALTAYactionCard.ALTAYcombat', this.playerHand).addClass('ALTAYselectable');
//
							for (let location of Object.keys(args.combatLocations)) dojo.addClass(`ALTAYregion-${location}`, 'ALTAYselectable');
//
							if ('ALTAYselected' in args) dojo.addClass(args.ALTAYselected, 'ALTAYselected');
//
							this.addActionButton('ALTAYcancel', _('cancel'), () => this.restoreServerGameState(), null, false, 'gray');
						}
						break;
//
					case 'surrenderOrFight':
//
						{
							this.addActionButton('ALTAYsurrender', _('Surrender'), () => this.setClientState('surrender', {descriptionmyturn: '${you} can discard up to ${attack} card(s)'}));
							this.addActionButton('ALTAYfight', _('Fight'), () => this.setClientState('fight', {descriptionmyturn: translate('${you} can play ${DEFENSE} card(s)')}));
						}
						break;
//
					case 'surrender':
//
						{
							dojo.addClass('ALTAYplayerHand', 'ALTAYselected');
							$(this.board).scrollIntoView({behavior: 'smooth', block: 'center'});
//
							dojo.query('.ALTAYactionCard', this.playerHand).addClass('ALTAYselectable');
//
							this.addActionButton('ALTAYcancel', _('cancel'), () => this.restoreServerGameState(), null, false, 'gray');
							this.addActionButton('ALTAYsurrender', _('Surrender'), () => {
								const nodes = dojo.query('.ALTAYactionCard.ALTAYselected', this.playerHand);
								this.bgaPerformAction('actSurrenderOrFight', {
									fight: false, cards: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
										.then(() => dojo.query('.ALTAYselectable').removeClass('ALTAYselectable'))
										.catch((e) => console.log(e));
							}, null, false, 'red');
						}
						break;
//
					case 'fight':
//
						{
							dojo.addClass('ALTAYplayerHand', 'ALTAYselected');
							$(this.board).scrollIntoView({behavior: 'smooth', block: 'center'});
//
							dojo.query('.ALTAYactionCard.ALTAYcombat', this.playerHand).addClass('ALTAYselectable');
//
							this.addActionButton('ALTAYcancel', _('cancel'), () => this.restoreServerGameState(), null, false, 'gray');
							this.addActionButton('ALTAYfight', _('Fight'), () => {
								const nodes = dojo.query('.ALTAYactionCard.ALTAYselected', this.playerHand);
								this.bgaPerformAction('actSurrenderOrFight', {
									fight: true, cards: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
										.then(() => dojo.query('.ALTAYselectable').removeClass('ALTAYselectable'))
										.catch((e) => console.log(e));
							}, null, false, 'red');
						}
						break;
//
					case 'gameTurn':
//
						{
							this.addActionButton('ALTAYundo', _('Undo all turn'), (event) => {
								dojo.stopEvent(event);
								this.bgaPerformAction('actUndo');
							});
							dojo.style('ALTAYundo', 'background-color', 'chocolate');
//
							this.addActionButton('ALTAYproduce', _('PLAY CARDS'), (event) => {
//							this.addActionButton('ALTAYproduce', _('PRODUCE RESOURCES'), (event) => {
								dojo.stopEvent(event);
								dojo.addClass('ALTAYplayerHand', 'ALTAYselected');
								$(this.board).scrollIntoView({behavior: 'smooth', block: 'center'});
							});
							this.addActionButton('ALTAYacquire', _('ACQUIRE NEW ACTION CARDS'), (event) => {
								dojo.stopEvent(event);
								dojo.removeClass('ALTAYplayerHand', 'ALTAYselected');
								$('ALTAYactionCardDisplay').scrollIntoView({behavior: 'smooth', block: 'center'});
							});
//							this.addActionButton('ALTAYcombat', _('COMBAT'), (event) => {
//								dojo.stopEvent(event);
//								this.setClientState('combat', {descriptionmyturn: _('Choose attacking territory then combat cards then attacked territory')});
//							});
							this.addActionButton('ALTAYdevelop', _('DEVELOP ACHIEVEMENTS'), (event) => {
								dojo.stopEvent(event);
								dojo.removeClass('ALTAYplayerHand', 'ALTAYselected');
								$('ALTAYachievementCardDisplay').scrollIntoView({behavior: 'smooth', block: 'center'});
							});
//
							this.addActionButton('ALTAYpass', _('End of Turn'), (event) => {
								dojo.stopEvent(event);
								$(this.board).scrollIntoView({behavior: 'instant', block: 'center'});
								dojo.addClass('ALTAYplayerHand', 'ALTAYselected');
								if (dojo.query('.ALTAYactionCard', this.playerHand).length === 0) this.bgaPerformAction('actPass');
								else this.confirmationDialog('You have unused cards in hand', () => this.bgaPerformAction('actPass'));
							}, null, false, 'red');
//
						}
						break;
//
					case 'playCard':
//
						{
							const actionCard = isNaN(args.card.type) ? this.gamedatas.ACTIONCARDS[args.card.type][args.card.type_arg] : this.gamedatas.ACTIONCARDS[(+args.card.type - 1) * 8 + +args.card.type_arg + 1];
							for (let variant in actionCard.variants)
							{
								const action = translate(actionCard.variants[variant]);
								this.addActionButton(`ALTAYvariant-${variant}`, action, () => {
									if (args.card.type === 'FIREFOLK' && +args.card.type_arg === 4 && +variant === 1) this.setClientState('consumeConquestMarker', {descriptionmyturn: action});
									else this.bgaPerformAction('actPlay', {id: args.card.id, variant: variant});
								}, null, false, 'gray');
							}
							this.addActionButton('ALTAYcancel', _('cancel'), () => this.restoreServerGameState(), null, false, 'gray');
						}
						break;
//
					case 'consumeConquestMarker':
//
						{
							for (let resource of ['FOOD', 'WOOD', 'METAL', 'STONE', 'CULTURE'])
							{
								const action = dojo.string.substitute('${' + resource + '}', {
									'FOOD': `<img draggable='false' class='ALTAYresource' data-resource='${_('FOOD')}' draggable='false' src='${g_gamethemeurl}img/SVG/FOOD.svg'>`,
									'WOOD': `<img draggable='false' class='ALTAYresource' data-resource='${_('WOOD')}' draggable='false' src='${g_gamethemeurl}img/SVG/WOOD.svg'>`,
									'METAL': `<img draggable='false' class='ALTAYresource' data-resource='${_('METAL')}' draggable='false' src='${g_gamethemeurl}img/SVG/METAL.svg'>`,
									'STONE': `<img draggable='false' class='ALTAYresource' data-resource='${_('STONE')}' draggable='false' src='${g_gamethemeurl}img/SVG/STONE.svg'>`,
									'CULTURE': `<img draggable='false' class='ALTAYresource' data-resource='${_('CULTURE')}' draggable='false' src='${g_gamethemeurl}img/SVG/CULTURE.svg'>`
								});
								this.addActionButton(`ALTAYconsumeConquestMarker-${resource}`, action, () => {
									this.bgaPerformAction('actPlay', {id: args.card.id, variant: 1, resource: resource});
								}, null, false, 'gray');
							}
							this.addActionButton('ALTAYcancel', _('cancel'), () => this.restoreServerGameState(), null, false, 'gray');
						}
						break;
				}
			}
		},
		setupNotifications: function ()
		{
			console.log('notifications subscriptions setup');
//
			dojo.subscribe('updateScore', (notif) => this.scoreCtrl[notif.args.player_id].setValue(notif.args.score));
			dojo.subscribe('lastTurn', () => this.gamedatas.lastTurn = true);
//
			dojo.subscribe('placeAchievement', (notif) => this.placeAchievement(notif.args.card));
			dojo.subscribe('developAchievement', (notif) => this.developAchievement(notif.args.card));
			dojo.subscribe('discardAchievement', (notif) => this.discardAchievement(notif.args.card));
//
			dojo.subscribe('faction', (notif) => this.faction(notif.args.faction, notif.args.player_id, notif.args.deck, notif.args.hand, notif.args.discard));
			dojo.subscribe('drawCard', (notif) => this.drawCard(notif.args.card));
			dojo.subscribe('playCard', (notif) => this.playCard(notif.args.card));
			dojo.subscribe('playOnTable', (notif) => this.playOnTable(notif.args.card));
			dojo.subscribe('discardCard', (notif) => this.discardCard(notif.args.card, notif.args.player_id));
//
			dojo.subscribe('placeMarker', (notif) => this.placeMarker(notif.args.marker));
			dojo.subscribe('consumeMarker', (notif) => this.consumeMarker(notif.args.marker));
			dojo.subscribe('removeMarker', (notif) => this.removeMarker(notif.args.marker));
//
			dojo.subscribe('placeResource', (notif) => this.placeResource(notif.args.resource));
			dojo.subscribe('removeResource', (notif) => this.removeResource(notif.args.resource));
//
			dojo.subscribe('placeSettlement', (notif) => this.placeSettlement(notif.args.settlement));
			dojo.subscribe('removeSettlement', (notif) => this.removeSettlement(notif.args.settlement));
//
			this.setSynchronous();
		}
		,
		setSynchronous()
		{
			this.notifqueue.setSynchronous('placeAchievement', DELAY);
			this.notifqueue.setSynchronous('developAchievement', DELAY);
			this.notifqueue.setSynchronous('discardAchievement', DELAY);
//
			this.notifqueue.setSynchronous('drawCard', DELAY);
			this.notifqueue.setSynchronous('playCard', DELAY);
			this.notifqueue.setSynchronous('playOnTable', DELAY);
			this.notifqueue.setSynchronous('discardCard', DELAY);
//
			this.notifqueue.setSynchronous('placeMarker', DELAY);
			this.notifqueue.setSynchronous('consumeMarker', DELAY);
			this.notifqueue.setSynchronous('removeMarker', DELAY);
//
			this.notifqueue.setSynchronous('placeResource', DELAY);
			this.notifqueue.setSynchronous('removeResource', DELAY);
//
			this.notifqueue.setSynchronous('placeSettlement', DELAY);
			this.notifqueue.setSynchronous('removeSettlement', DELAY);
		},
		faction(faction, player_id, deck, hand, discard)
		{
			console.log('faction', faction, player_id, deck, hand, discard);
//
			let node = $(`ALTAYfaction-${faction}`);
//
			if (!node)
			{
				node = dojo.place(`<img draggable='false' id='ALTAYfaction-${faction}' draggable='false' class='ALTAYfaction ${faction}' src='${g_gamethemeurl}img/SVG/${faction}.svg'>`, `ALTAYfactionDisplay-${player_id}`, 'first');
				dojo.connect(node, 'click', (event) => {
					dojo.stopEvent(event);
					dojo.query('.ALTAYresource', `ALTAYresources-${player_id}`).removeClass('ALTAYselected');
				});
				$(`ALTAYsettlementMarkerContainer-${player_id}`).dataset.type = faction;
			}
//
			$(`ALTAYplayerDeck-${player_id}-value`).innerHTML = deck;
			$(`ALTAYplayerHand-${player_id}-value`).innerHTML = hand;
			$(`ALTAYplayerDiscard-${player_id}-value`).innerHTML = discard;
		},
		placeAchievement(card)
		{
			console.log('placeAchievement', card);
//
			const node = dojo.place(achievementCard(card), `ALTAYachievementCard-${card.type}-${card.location_arg}`);
			dojo.connect(node, 'click', (event) => {
				dojo.stopEvent(event);
				if (this.isCurrentPlayerActive())
				{
					const nodes = dojo.query('.ALTAYresource.ALTAYselected', `ALTAYresources-${this.player_id}`);
					if (nodes.length === 0)
					{
						if (this.getGameUserPreference(COST)) this.bgaPerformAction('actDevelopAchievement', {id: card.id})
									.then(() => nodes.removeClass('ALTAYselected'))
									.catch((e) => console.log(e));
					}
					else this.bgaPerformAction('actDevelopAchievement', {id: card.id, resources: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
								.then(() => nodes.removeClass('ALTAYselected'))
								.catch((e) => console.log(e));
				}
			});
		},
		discardAchievement(card)
		{
			console.log('discardAchievement', card);
//
			const node = $(`ALTAYachievement-${card.id}`);
			if (node)
			{
				dojo.style(node, 'transform', 'none');
				dojo.style(node, 'width', `${node.clientWidth}px`);
				dojo.style(node, 'z-index', 100);
				this.slideToObjectAndDestroy(this.attachToNewParent(node, 'logoicon'), 'logoicon', DELAY);
			}
		},
		developAchievement(card)
		{
			console.log('developAchievement', card);
//
			const node = dojo.place(achievementCard(card), `ALTAYachievement-${card.location_arg}`);
			dojo.connect(node, 'click', (event) => {
				dojo.stopEvent(event);
				if (this.isCurrentPlayerActive() && dojo.hasClass(node, 'ALTAYselectable'))
				{
					if (this.gamedatas.gamestate.name === 'gameTurn')
					{
						const nodes = dojo.query('.ALTAYresource', node);
						if (nodes.length > 0)
						{
							const nodes = dojo.query('.ALTAYresource.ALTAYselected', `ALTAYresources-${this.player_id}`);
							if (nodes.length === 0)
							{
								const achievementCard = this.gamedatas.ACHIEVEMENTS[card.type][card.type_arg];
								if (+node.dataset.type === 3) return this.showMessage('Unlike technologies, you can never discard a wonder after you start to develop it');
								this.confirmationDialog(dojo.string.substitute(_('Stop producing <B>${title}</B>'), {title: _(achievementCard.title)}), () => this.bgaPerformAction('actAchievement', {id: card.id, discard: true}));
							}
							else this.bgaPerformAction('actAchievement', {id: card.id, resources: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
										.then(() => nodes.removeClass('ALTAYselected'))
										.catch((e) => console.log(e));
						}
						else this.bgaPerformAction('actAchievementEffect', {id: card.id})
									.then(() => nodes.removeClass('ALTAYselected'))
									.catch((e) => console.log(e));
					}
				}
			});
		},
		drawCard(card)
		{
			console.log('drawCard', card);
//
			const node = dojo.place(actionCard(card), this.playerHand);
			this.placeOnObject(node, this.getPlayerPanelElement(this.player_id));
//
			const anim = this.slideToObject(node, this.playerHand, DELAY);
			anim.onEnd = (node) => {
				dojo.destroy(node);
				this.placeCard(card);
			};
			anim.play();
		},
		placeCard(card)
		{
			console.log('placeCard', card);
//
			const node = dojo.place(actionCard(card), this.playerHand);
//
			dojo.connect(node, 'click', (event) => {
				dojo.stopEvent(event);
				if (this.isCurrentPlayerActive())
				{
					if (this.gamedatas.gamestate.name === 'gameTurn') this.playCard(card);
					if (this.gamedatas.gamestate.name === 'combat') if (dojo.hasClass(node, 'ALTAYselectable')) dojo.toggleClass(node, 'ALTAYselected');
					if (this.gamedatas.gamestate.name === 'surrender') if (dojo.hasClass(node, 'ALTAYselectable')) dojo.toggleClass(node, 'ALTAYselected');
					if (this.gamedatas.gamestate.name === 'fight') if (dojo.hasClass(node, 'ALTAYselectable')) dojo.toggleClass(node, 'ALTAYselected');
				}
			});
		},
		playCard(card)
		{
			console.log('playCard', card);
//
			let node = $(`ALTAYcard-${card.id}`);
			if (node)
			{
				if (!dojo.hasClass(node, 'ALTAYcombat'))
				{
					dojo.style(node, 'transform', 'none');
					dojo.style(node, 'width', `${node.clientWidth}px`);
					dojo.style(node, 'z-index', 100);
					node = this.attachToNewParent(node, this.board);
					const anim = this.slideToObject(node, this.board, DELAY);
					anim.onEnd = () =>
					{
						if (this.getGameUserPreference(AUTO))
						{
							const intervalID = setInterval(() => {
//
								if (this.isInterfaceLocked()) return;
								clearInterval(intervalID);
//
								if (node.dataset.type === 'EARTHFOLK' && [3, 4, 5].includes(+node.dataset.type_arg)) return this.bgaPerformAction('actPlay', {id: node.dataset.id, variant: 0});
								if (node.dataset.type === 'ELVENFOLK' && [1, 2, 3, 4, 5].includes(+node.dataset.type_arg)) return this.bgaPerformAction('actPlay', {id: node.dataset.id, variant: 0});
								if (node.dataset.type === 'FIREFOLK' && [1, 2, 3].includes(+node.dataset.type_arg)) return this.bgaPerformAction('actPlay', {id: node.dataset.id, variant: 0});
								if (node.dataset.type === 'SMALLFOLK' && [1, 2, 3, 4, 5, 6].includes(+node.dataset.type_arg)) return this.bgaPerformAction('actPlay', {id: node.dataset.id, variant: 0});
								if ([1, 2, 3, 4].includes(+node.dataset.type)) return this.bgaPerformAction('actPlay', {id: node.dataset.id, variant: 1, auto: true});
//
							}, 250);
						}
						this.setClientState('playCard', {args: {card: card}});
					};
					anim.play();
				}
				else this.setClientState('combat', {ALTAYselected: node.id, descriptionmyturn: _('Choose attacking territory then combat cards then attacked territory')});
			}
		},
		playOnTable(card)
		{
			console.log('playOnTable', card);
//
			const node = dojo.place(actionCard(card), `ALTAYplayOnTable-${card.location_arg}`);
			dojo.connect(node, 'click', (event) => {
				dojo.stopEvent(event);
				if (this.isCurrentPlayerActive() && dojo.hasClass(node, 'ALTAYselectable'))
				{
					if (this.gamedatas.gamestate.name === 'gameTurn')
					{
						const nodes = dojo.query('.ALTAYresource.ALTAYselected', `ALTAYresources-${this.player_id}`);
						if (nodes.length === 0)
						{
							const actionCard = isNaN(card.type) ? this.gamedatas.ACTIONCARDS[card.type][card.type_arg] : this.gamedatas.ACTIONCARDS[(+card.type - 1) * 8 + +card.type_arg + 1];
							this.confirmationDialog(dojo.string.substitute(_('Discard <B>${title}</B>'), {title: _(actionCard.title)}), () => this.bgaPerformAction('actEffect', {id: card.id, discard: true}));
						}
						else this.bgaPerformAction('actEffect', {id: card.id, resources: JSON.stringify(nodes.reduce((L, node) => [...L, node.dataset.id], []))})
									.then(() => nodes.removeClass('ALTAYselected'))
									.catch((e) => console.log(e));
					}
				}
			});
		},
		discardCard(card)
		{
			console.log('discardCard', card);
//
			const node = $(`ALTAYcard-${card.id}`);
			if (node)
			{
				dojo.style(node, 'transform', 'none');
				dojo.style(node, 'width', `${node.clientWidth}px`);
				dojo.style(node, 'z-index', 100);
				this.slideToObjectAndDestroy(this.attachToNewParent(node, 'logoicon'), 'logoicon', DELAY);
			}
		},
		placeMarker(marker)
		{
			console.log('placeMarker', marker);
//
			if (marker.location <= 25)
			{
				switch (marker.type)
				{
					case 'P1':
					case 'P2':
					case 'P3':
					case 'P4':
//
						{
							const node = dojo.place(`<div id='ALTAYmarker-${marker.id}' style='z-index:100;width:10cqw;height:10cqw;line-height:10cqw;font-size:5cqw;font-weight:bold;text-align:center;background-color:white;color:black;border-radius:50%;'>${marker.type}</div>`, this.board);
							dojo.style(node, {
								position: 'absolute',
								left: `CALC(${BOARD[marker.location][0] - 0}% - ${node.clientWidth / 2}px)`,
								top: `CALC(${BOARD[marker.location][1] - 0}% - ${node.clientHeight / 2}px)`
							});
						}
						break;
					default:
//
						const node = dojo.place(`<div id='ALTAYmarker-${marker.id}' class='ALTAYmarker' tabindex='0' data-type='${marker.type}' data-location='${marker.location}'></div>`, this.board);
						dojo.connect(node, 'click', (event) => {
							dojo.stopEvent(event);
							$(`ALTAYregion-${marker.location}`).click();
						});
						if (marker.type[0] === 'x') dojo.addClass(node, 'ALTAYconquestMarker');
						dojo.style(node, {
							position: 'absolute',
							left: `CALC(${BOARD[marker.location][0] - 0}% - ${node.clientWidth / 2}px)`,
							top: `CALC(${BOARD[marker.location][1] - 0}% - ${node.clientHeight / 2}px)`
						});
				}
			}
			else
			{
				const node = dojo.place(`<div id='ALTAYmarker-${marker.id}' class='ALTAYmarker' tabindex='0' data-type='${marker.type}' data-location='${marker.location}'></div>`, `ALTAYconquestMarkerContainer-${marker.location}`);
				if (marker.type[0] === 'x') dojo.addClass(node, 'ALTAYconquestMarker');
				if (this.gamedatas.consumed.includes(+marker.id)) dojo.style(node, 'opacity', '25%');
			}
		},
		consumeMarker(marker)
		{
			console.log('consumeMarker', marker);
//
			const node = $(`ALTAYmarker-${marker}`);
			if (node) dojo.style(node, 'opacity', '25%');
		},
		removeMarker(marker)
		{
			console.log('removeMarker', marker);
//
			const node = $(`ALTAYmarker-${marker.id}`);
			if (node)
			{
				dojo.style(node, 'z-index', 10000);
				const anim = this.slideToObject(node, 'topbar', DELAY);
				anim.onEnd = () => dojo.destroy(node);
				anim.play();
			}
		},
		placeResource(resource)
		{
			console.log('placeResource', resource);
//
			if (isNaN(resource.location))
			{
				const node = dojo.place(`<img draggable='false' id='ALTAYresource-${resource.id}' class='ALTAYresource' data-id='${resource.id}' data-resource='${resource.type}' draggable='false' src='${g_gamethemeurl}img/SVG/${resource.type}.svg'>`, resource.location);
				dojo.connect(node, 'click', (event) => {
					dojo.stopEvent(event);
					if (this.isCurrentPlayerActive() && /^ALTAYcard-[0-9]+$/.test(resource.location)) this.bgaPerformAction('actEffect', {id: $(resource.location).dataset.id});
				});
				dojo.query('.ALTAYresource', resource.location).sort((a, b) => SORT[a.dataset.resource] - SORT[b.dataset.resource]).forEach((node) => node.parentNode.appendChild(node));
			}
			else
			{
				const node = dojo.place(`<img draggable='false' id='ALTAYresource-${resource.id}' class='ALTAYresource' data-id='${resource.id}' data-resource='${resource.type}' draggable='false' src='${g_gamethemeurl}img/SVG/${resource.type}.svg'>`, `ALTAYresources-${resource.location}`);
				dojo.connect(node, 'click', (event) => {
					dojo.stopEvent(event);
					if (this.isCurrentPlayerActive()) dojo.query(`.ALTAYresource[data-id='${resource.id}'`).toggleClass('ALTAYselected');
				});
				dojo.query('.ALTAYresource', `ALTAYresources-${resource.location}`).sort((a, b) => SORT[a.dataset.resource] - SORT[b.dataset.resource]).forEach((node) => node.parentNode.appendChild(node));
			}
		},
		removeResource(resource)
		{
			console.log('removeResourcet', resource);
//
			const node = $(`ALTAYresource-${resource.id}`);
			if (node)
			{
				dojo.style(node, 'z-index', 10000);
				const anim = this.slideToObject(node, 'topbar', DELAY);
				anim.onEnd = () => dojo.destroy(node);
				anim.play();
			}
		},
		placeSettlement(settlement)
		{
			console.log('placeSettlement', settlement);
//
			if (settlement.location <= 25)
			{
				const node = dojo.place(`<div id='ALTAYsettlement-${settlement.id}' class='ALTAYsettlement ${settlement.faction}' tabindex='0' data-id='${settlement.id}' data-type='${settlement.faction}' data-location='${settlement.location}'></div>`, this.board);
				dojo.connect(node, 'click', (event) => {
					dojo.stopEvent(event);
					$(`ALTAYregion-${settlement.location}`).click();
				});
//
				index = 0;
				dojo.query(`.ALTAYsettlement[data-location='${settlement.location}']`, this.board).forEach((node) => {
					dojo.style(node, {
						position: 'absolute',
						left: `CALC(${BOARD[settlement.location][0] - 0 + 1 * index}% - ${node.clientWidth / 2}px)`,
						top: `CALC(${BOARD[settlement.location][1] - 0 + 2 * index}% - ${node.clientHeight / 2}px)`
					});
					index++;
				});
			}
			else if (/^ALTAYachievement-\d+$/.test(settlement.location))
			{
				const node = dojo.place(`<div id='ALTAYsettlement-${settlement.id}' class='ALTAYsettlement ${settlement.faction}' tabindex='0' data-id='${settlement.id}' data-type='${settlement.faction}' data-location='${settlement.location}'></div>`, settlement.location, 'fisrt');
			}
			else
			{
				const node = dojo.place(`<div id='ALTAYsettlement-${settlement.id}' class='ALTAYsettlement ${settlement.faction}' tabindex='0' data-id='${settlement.id}' data-type='${settlement.faction}' data-location='${settlement.location}'></div>`, `ALTAYsettlementMarkerContainer-${settlement.location}`);
			}
		},
		removeSettlement(settlement)
		{
			console.log('removeSettlement', settlement);
//
			const node = $(`ALTAYsettlement-${settlement.id}`);
			if (node)
			{
				dojo.style(node, 'z-index', 10000);
				const anim = this.slideToObject(node, 'topbar', DELAY);
				anim.onEnd = () => dojo.destroy(node);
				anim.play();
			}
		},
		format_string_recursive: function (log, args)
		{
			if (log && args && !args.processed)
			{
				args.processed = true;
//
				if ('faction' in args)
					args.faction = `<img draggable='false' class='ALTAYfaction ${_(args.faction)}' src='${g_gamethemeurl}img/SVG/${args.faction}.svg'>`;
				if ('region' in args)
					args.region = this.REGIONS[args.region];
				if ('resource' in args)
					args.resource = `<img draggable='false' class='ALTAYresource' data-resource='${args.resource}' src='${g_gamethemeurl}img/SVG/${args.resource}.svg'>`;
				if ('resources' in args)
					args.resources = args.resources.reduce((s, resource) => s + `<img draggable='false' class='ALTAYresource' src='${g_gamethemeurl}img/SVG/${resource}.svg'>`, '');
			}
			return this.inherited(arguments);
		},
		onGameUserPreferenceChanged: function (pref, value)
		{
			switch (pref)
			{
				case SPEED:
//
					DELAY = DELAYS[ +value];
					document.documentElement.style.setProperty('--DELAY', DELAY);
//
					return this.setSynchronous();
			}
		}
	}
	);
}
);
