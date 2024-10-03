<?php
/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
declare(strict_types=1);
//
define("FARMLAND", 0);
define("FOREST", 1);
define("HILL", 2);
define("MOUNTAIN", 3);
//
const FIRSTPLAYER = "firstPlayer";
//
require_once(APP_GAMEMODULE_PATH . "module/table/table.game.php");
require_once('modules/PHP/gameStates.php');
require_once('modules/PHP/gameStateArguments.php');
require_once('modules/PHP/gameStateActions.php');
require_once('modules/PHP/Factions.php');
require_once('modules/PHP/Board.php');
require_once('modules/PHP/Tokens.php');
require_once('modules/PHP/Markers.php');

class Altay extends Table
{
	use gameStates;
	use gameStateArguments;
	use gameStateActions;

	public function __construct()
	{
		parent::__construct();
//
		$this->initGameStateLabels([]);
//
// Initialize decks
//
		$this->actionCards = self::getNew("module.common.deck");
		$this->actionCards->init("actionCards");
//
		$this->achievementCards = self::getNew("module.common.deck");
		$this->achievementCards->init("achievementCards");
	}
	public function getGameProgression()
	{
		return 0;
	}
	protected function getAllDatas()
	{
		$result = [];
//
		$player_id = intval(self::getCurrentPlayerId());
//
		$result["players"] = $this->getCollectionFromDb("SELECT player_id, player_score score FROM player");
//
		$result["actionCards"][1] = $this->actionCards->getCardsInLocation("display-1", null, 'location_arg');
		$result["actionCards"][2] = $this->actionCards->getCardsInLocation("display-2", null, 'location_arg');
		$result["actionCards"][3] = $this->actionCards->getCardsInLocation("display-3", null, 'location_arg');
		$result["actionCards"][4] = $this->actionCards->getCardsInLocation("display-4", null, 'location_arg');
		$result["actionCards"][5] = $this->actionCards->getCardsInLocation("display-5", null, 'location_arg');
		$result["actionCards"][6] = $this->actionCards->getCardsInLocation("display-6", null, 'location_arg');
		$result["actionCards"][7] = $this->actionCards->getCardsInLocation("display-7", null, 'location_arg');
		$result["actionCards"][8] = $this->actionCards->getCardsInLocation("display-8", null, 'location_arg');
		$result["actionCards"][9] = $this->actionCards->getCardsInLocation("display-9", null, 'location_arg');
		$result["actionCards"][10] = $this->actionCards->getCardsInLocation("display-10", null, 'location_arg');
		$result["actionCards"][11] = $this->actionCards->getCardsInLocation("display-11", null, 'location_arg');
//
		$result["achievementCards"]["level-1"] = $this->achievementCards->getCardsInLocation("level-1");
		$result["achievementCards"]["level-2"] = $this->achievementCards->getCardsInLocation("level-2");
		$result["achievementCards"]["level-3"] = $this->achievementCards->getCardsInLocation("level-3");
//
		$result['factions'] = Factions::getAllDatas();
		$result['tokens'] = Tokens::getAllDatas();
		$result['markers'] = Markers::getAllDatas();
//
		$result['hand'] = $this->actionCards->getPlayerHand($player_id);
//
		return $result;
	}
	protected function getGameName()
	{
		return "altay";
	}
	protected function setupNewGame($players, $options = [])
	{
		$gameinfos = $this->getGameinfos();
		$default_colors = $gameinfos['player_colors'];
//
		foreach ($players as $player_id => $player) $query_values[] = vsprintf("('%s', '%s', '%s', '%s', '%s')", [$player_id, array_shift($default_colors), $player["player_canal"], addslashes($player["player_name"]), addslashes($player["player_avatar"]),]);
		static::DbQuery(sprintf("INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES %s", implode(",", $query_values)));
//
		$this->reattributeColorsBasedOnPreferences($players, $gameinfos["player_colors"]);
		$this->reloadPlayersBasicInfos();
	}
	protected function zombieTurn(array $state, int $active_player): void
	{
		$state_name = $state["name"];
		if ($state["type"] === "activeplayer")
		{
			switch ($state_name)
			{
				default:
					{
						$this->gamestate->nextState("zombiePass");
						break;
					}
			}
			return;
		}
		if ($state["type"] === "multipleactiveplayer")
		{
			$this->gamestate->setPlayerNonMultiactive($active_player, '');
			return;
		}
		throw new feException("Zombie mode not supported at this game state: \"{$state_name}\".");
	}
}
