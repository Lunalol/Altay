/* global g_gamethemeurl, ebg, _ */

const DELAY = 250;
const COLORS = {ELVENFOLK: '#47a34b', EARTHFOLK: '#ebb41b', SMALLFOLK: '#00a7d2', FIREFOLK: '#e12129'};
define(["dojo", "dojo/_base/declare", "ebg/core/gamegui", "ebg/counter",
	g_gamethemeurl + "modules/JavaScript/constants.js",
	g_gamethemeurl + "modules/JavaScript/actionCards.js"
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
			console.log("Starting game setup", gamedatas);
//
// Translations
//
			this.FACTIONS = {
				ELVENFOLK: _('In the forests, danced the <B>Elvenfolk</B>'),
				EARTHFOLK: _('In the deep caves, there dweit the <B>Earthfolk</B>'),
				SMALLFOLK: _('By the shore, dancing with the crashing waves, there lived the <B>SmallFolk</B>'),
				FIREFOLK: _('Beyond the Land, on the other side of the fire, there raged the <B>Firefolk</B>')
			};
//
// Player panels
//
			for (let player_id in gamedatas.players)
			{
				const node = this.getPlayerPanelElement(player_id);
				dojo.place(`<div id='ALTAYresources-${player_id}' class='ALTAYresources'></div>`, node);
			}
//
// Board
//
			this.board = $('ALTAYboard');
//
			for (let [location, [X, Y]] of Object.entries(BOARD))
			{
				const node = dojo.place(`<div id='ALTAYregion-${location}' class='ALTAYregion' tabindex='0'></div>`, this.board);
				dojo.style(node, {position: 'absolute', left: `${X - 10}%`, top: `${Y - 12.5}%`});
				dojo.connect(node, 'click', (event) =>
				{
					dojo.stopEvent(event);
					if (this.isCurrentPlayerActive())
					{
						switch (this.gamedatas.gamestate.name)
						{
//
							case 'settlementChoice':
//
								return this.bgaPerformAction('actSettlementChoice', {location: location}).then(() => dojo.query('.ALTAYselectable').removeClass('ALTAYselectable'));
//
						}
					}
				});
			}
//
// Markers & Tokens
//
			for (let marker of Object.values(gamedatas.markers)) this.placeMarker(marker);
			for (let token of Object.values(gamedatas.tokens)) this.placeToken(token);
//
// Achievement decks
//
			for (let [level, achievementCards] of Object.entries(gamedatas.achievementCards))
			{
				dojo.place(`<div class='ALTAYachievementCards ALTAY${level}' style='grid-row:${level};grid-column:level;'></div>`, 'ALTAYachievementCardDisplay');
//
				dojo.place(`<div id='ALTAYachievementCard-${level}-1' class='ALTAYachievementCardHolder' style='grid-row:${level};grid-column:cards 1;'></div>`, 'ALTAYachievementCardDisplay');
				dojo.place(`<div id='ALTAYachievementCard-${level}-2' class='ALTAYachievementCardHolder' style='grid-row:${level};grid-column:cards 2;'></div>`, 'ALTAYachievementCardDisplay');
				dojo.place(`<div id='ALTAYachievementCard-${level}-3' class='ALTAYachievementCardHolder' style='grid-row:${level};grid-column:cards 3;'></div>`, 'ALTAYachievementCardDisplay');
//
				for (let card of Object.values(achievementCards))
				{
					dojo.place(`<div class='ALTAYachievementCards ALTAY${level}' style='background-position-x:${card.type_arg * 100 / 10}%'></div>`, `ALTAYachievementCard-${level}-${card.location_arg}`);
				}
			}
//
// Action decks
//
			for (let [type, actionCards] of Object.entries(gamedatas.actionCards))
			{
				const node = dojo.place(`<div class='ALTAYactionCardHolder'></div>`, 'ALTAYactionCardDisplay');
//
				for (let card of actionCards)
				{
					dojo.place(`<div class='ALTAYactionCards ALTAYactionCard' style='background-position-x:${((card.type - 1) * 8 + +card.type_arg) * 100 / 87}%'></div>`, node, 'first');
				}
			}
//
// Player hand
//
			this.playerHand = $('ALTAYplayerHand');
			for (let card of Object.values(gamedatas.hand)) this.placeCard(card);
//
			this.setupNotifications();
//
			console.log("Ending game setup");
		},
		onEnteringState: function (stateName, state)
		{
			console.log('Entering state: ' + stateName, state.args);
//
			switch (stateName)
			{
			}
		},
		onLeavingState: function (stateName)
		{
			console.log('Leaving state: ' + stateName);
//
			dojo.query('.ALTAYselectable').removeClass('ALTAYselectable');
			dojo.query('.ALTAYselectede').removeClass('ALTAYselected');
			dojo.query('.ALTAYdisabled').removeClass('ALTAYdisabled');
		},
		onUpdateActionButtons: function (stateName, args)
		{
			console.log('onUpdateActionButtons: ' + stateName, args);
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
								for (let card = 1; card <= 10; card++)
								{
									html += `<div class='ALTAYactionCards ALTAYactionCard ${faction}' style='width:100px;background-position-x:${(card - 1) * 100 / 87}%;'></div>`;
								}
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
									return this.bgaPerformAction('actFactionChoice', {faction: faction}).then(() => dialog.destroy());
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
					case 'gameTurn':
//
						{
							this.addActionButton('ALTAYpass', _('End of Turn'), (event) => {
								dojo.stopEvent(event);
								if (dojo.query('.ALTAYactionCard', this.playerHand).length === 0) this.bgaPerformAction('pass');
								else this.confirmationDialog('You have unused cards in hand', () => this.bgaPerformAction('pass'));
							}, null, false, 'red');
						}
						break;
				}
			}
		},
		setupNotifications: function ()
		{
			console.log('notifications subscriptions setup');
//
			dojo.subscribe('drawCard', (notif) => this.drawCard(notif.args.card));
			dojo.subscribe('playCard', (notif) => this.playCard(notif.args.card));
			dojo.subscribe('discardCard', (notif) => this.discardCard(notif.args.card));
//
			dojo.subscribe('placeMarker', (notif) => this.placeMarker(notif.args.marker));
			dojo.subscribe('removeMarker', (notif) => this.removeMarker(notif.args.marker));
//
			dojo.subscribe('placeToken', (notif) => this.placeToken(notif.args.token));
			dojo.subscribe('removeToken', (notif) => this.removeToken(notif.args.token));
//
			this.setSynchronous();
		},
		setSynchronous()
		{
			this.notifqueue.setSynchronous('drawCard', DELAY);
			this.notifqueue.setSynchronous('playCard', DELAY);
			this.notifqueue.setSynchronous('discardCard', DELAY);
//
			this.notifqueue.setSynchronous('placeMarker', DELAY / 4);
			this.notifqueue.setSynchronous('removeMarker', DELAY);
//
			this.notifqueue.setSynchronous('placeToken', DELAY / 4);
			this.notifqueue.setSynchronous('removeToken', DELAY / 4);
		},
		drawCard(card)
		{
			console.log('drawCard', card);
//
			const node = dojo.place(actionCard(card), this.getPlayerPanelElement(this.player_id));
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
				this.playCard(card);
			});
		},
		playCard(card)
		{
			console.log('playCard', card);
//
			let node = $(`ALTAYcard-${card.id}`);
			if (node)
			{
				dojo.style(node, 'transform', 'none');
				dojo.style(node, 'width', `${node.clientWidth}px`);
				dojo.style(node, 'z-index', 100);
				node = this.attachToNewParent(node, 'ALTAYboard');
				const anim = this.slideToObject(node, 'ALTAYboard', DELAY);
				anim.onEnd = () => {
					const actionCard = isNaN(card.type) ? this.gamedatas.ACTIONCARDS[card.type][card.type_arg] : this.gamedatas.ACTIONCARD[(card.type - 1) * 8 + card.type_arg];
					this.removeActionButtons();
					for (let variant = 0; variant <= 2; variant++)
					{
						if (actionCard[variant])
						{
							this.addActionButton(`ALTAYvariant-${variant}`, dojo.string.substitute(_(actionCard[variant]), {
								'food': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/FOOD.svg'>`,
								'wood': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/WOOD.svg'>`,
								'metal': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/METAL.svg'>`,
								'stone': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/STONE.svg'>`,
								'culture': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/CULTURE.svg'>`,
								'settlement': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/SETTLEMENT.svg'>`,
								'attack': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/ATTACK.svg'>`,
								'defense': `<img style='margin:2px;height:25px;vertical-align:middle;' draggable='false' src='${g_gamethemeurl}img/SVG/DEFENSE.svg'>`
							}), () => this.bgaPerformAction('actPlay', {id: card.id, variant: variant}), null, false, 'gray');
						}
					}
					this.addActionButton('ALTAYcancel', _('cancel'), () => {
						dojo.destroy(node);
						this.placeCard(card);
						this.restoreServerGameState();
					});
				};
				anim.play();
			}
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
			const node = dojo.place(`<div id='ALTAYmarker-${marker.id}' class='ALTAYmarker' tabindex='0' data-type='${marker.type}' data-location='${marker.location}'></div>`, this.board);
			if (marker.type[0] === 'x') dojo.addClass(node, 'ALTAYconquestMarker');
			dojo.style(node, {
				position: 'absolute',
				left: `CALC(${BOARD[marker.location][0] - 0}% - ${node.clientWidth / 2}px)`,
				top: `CALC(${BOARD[marker.location][1] - 0}% - ${node.clientHeight / 2}px)`
			});
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
		placeToken(token)
		{
			console.log('placeToken', token);
//
			switch (token.type)
			{
				case 'FOOD':
				case 'WOOD':
				case 'METAL':
				case 'STONE':
				case 'CULTURE':
					{
						dojo.place(`<img style='margin:2px;' draggable='false' src='${g_gamethemeurl}img/SVG/${token.type}.svg'>`, `ALTAYresources-${token.location}`);
					}
					break;
				case 'EARTHFOLK':
				case 'ELVENFOLK':
				case 'FIREFOLK':
				case 'SMALLFOLK':
					{
						const node = dojo.place(`<div id='ALTAYtoken-${token.id}' class='ALTAYtoken' tabindex='0' data-type='${token.type}' data-location='${token.location}'></div>`, this.board);
						dojo.style(node, {
							position: 'absolute',
							left: `CALC(${BOARD[token.location][0] - 0}% - ${node.clientWidth / 2}px)`,
							top: `CALC(${BOARD[token.location][1] - 0}% - ${node.clientHeight / 2}px)`
						});
					}
					break;
			}
		}
	});
});
