<?php
/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */

namespace Bga\Games\ALTAY;

class Settlements extends \APP_GameClass
{
	static function create(string $faction, string $location): int
	{
		self::DbQuery("INSERT INTO settlements (faction,location) VALUES ('$faction','$location')");
		return self::DbGetLastId();
	}
	static function destroy(int $id): void
	{
		self::DbQuery("DELETE FROM settlements WHERE id = $id");
	}
	static function getAllDatas(): array
	{
		return self::getCollectionFromDB("SELECT * FROM settlements ORDER BY faction");
	}
	static function get(int $id): array
	{
		return self::getObjectListFromDB("SELECT * FROM settlements WHERE id = $id")[0];
	}
	static function getAt(string $location, string|null $faction = null): array
	{
		if ($faction) return self::getCollectionFromDB("SELECT * FROM settlements WHERE location = '$location' AND faction = '$faction'");
		return self::getCollectionFromDB("SELECT * FROM settlements WHERE location = '$location' ORDER BY faction");
	}
	static function getTerritories(string $faction): array
	{
		$territories = [FARMLAND => 0, FOREST => 0, HILL => 0, MOUNTAIN => 0];
		foreach (self::getOwned($faction) as $location) $territories[Board::REGIONS[$location]]++;
		return $territories;
	}
	static function getOwner(string $location)
	{
		return self::getUniqueValueFromDB("SELECT DISTINCT faction FROM settlements WHERE location = '$location'");
	}
	static function getOwned(string $faction): array
	{
		return self::getObjectListFromDB("SELECT DISTINCT location FROM settlements WHERE faction = '$faction' AND location REGEXP '^[0-9]+$' AND location <= 25", true);
	}
	static function place(string $faction): array
	{
		$disabled = Board::getDisabled();
//
		foreach (array_keys(Board::REGIONS) as $location)
		{
			$settlements = self::getAt($location);
//
			$self[$location] = sizeof(array_filter($settlements, fn($settlement) => $settlement['faction'] === $faction));
			$ennemy[$location] = sizeof(array_filter($settlements, fn($settlement) => $settlement['faction'] !== $faction));
		}
//
		$locations = [];
		foreach (array_keys(Board::REGIONS) as $location)
		{
			if (in_array($location, $disabled)) continue;
//
			if ($self[$location] > 0 && $ennemy[$location] === 0)
			{
				if ($self[$location] < 4) $locations[] = $location;
				foreach (Board::ADJACENCY[$location] as $next_location) if (!in_array($next_location, $disabled) && !Markers::getConquestMarkersAt($next_location) && $self[$next_location] === 0 && $ennemy[$next_location] === 0) $locations[] = $next_location;
			}
		}
//
		return $locations;
	}
	static function combat(string $faction): array
	{
		$disabled = Board::getDisabled();
//
		$locations = [];
		foreach (self::getOwned($faction) as $location)
		{
			$locations[$location] = [];
			foreach (Board::ADJACENCY[$location] as $next_location) if (!in_array($next_location, $disabled) && (Markers::getConquestMarkersAt($next_location) || (self::getOwned($next_location) && self::getOwned($next_location) !== $faction))) $locations[$location][] = $next_location;
		}
//
		return $locations;
	}
	static function resettle(string $faction): array
	{
		$disabled = Board::getDisabled();
//
		$locations = [];
		foreach (self::getOwned($faction) as $location)
		{
			$locations[$location] = [];
			foreach (Board::ADJACENCY[$location] as $next_location) if (!in_array($next_location, $disabled) && (!Markers::getConquestMarkersAt($next_location) || self::getOwned($next_location) === $faction)) $locations[$location][] = $next_location;
		}
//
		return $locations;
	}
}
