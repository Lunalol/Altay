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
		if ($faction) return self::getCollectionFromDB("SELECT * FROM settlements WHERE location = '$location' WHERE faction = '$faction'");
		return self::getCollectionFromDB("SELECT * FROM settlements WHERE location = '$location' ORDER BY faction");
	}
	static function getTerritories($faction)
	{
		$territories = [FARMLAND => 0, FOREST => 0, HILL => 0, MOUNTAIN => 0];
		foreach (self::getObjectListFromDB("SELECT DISTINCT location FROM settlements WHERE faction = '$faction' AND location <= 25", true) as $location) $territories[Board::REGIONS[$location]]++;
		return $territories;
	}
	static function place(string $faction): array
	{
		$locations = [];
//
		foreach (array_keys(Board::REGIONS) as $location)
		{
			$settlements = self::getAt($location);
//
			$self[$location] = sizeof(array_filter($settlements, fn($settlement) => $settlement['faction'] === $faction));
			$ennemy[$location] = sizeof(array_filter($settlements, fn($settlement) => $settlement['faction'] !== $faction));
		}
//
		foreach (array_keys(Board::REGIONS) as $location)
		{
			if ($self[$location] > 0 && $ennemy[$location] === 0)
			{
				if ($self[$location] < 4) $locations[] = $location;
				foreach (Board::ADJACENCY[$location] as $next_location) if (!Markers::getConquestMarkersAt($next_location) && $self[$next_location] === 0 && $ennemy[$next_location] === 0) $locations[] = $next_location;
			}
		}
//
		return $locations;
	}
	static function combat(string $faction): array
	{
		$locations = [];
//
		foreach (array_keys(Board::REGIONS) as $location)
		{
			$settlements = self::getAt($location);
//
			$self[$location] = sizeof(array_filter($settlements, fn($settlement) => $settlement['faction'] === $faction));
			$ennemy[$location] = sizeof(array_filter($settlements, fn($settlement) => $settlement['faction'] !== $faction));
		}
//
		foreach (array_keys(Board::REGIONS) as $location)
		{
			if ($self[$location] > 0 && $ennemy[$location] === 0)
			{
				$locations[$location] = [];
				foreach (Board::ADJACENCY[$location] as $next_location) if (Markers::getConquestMarkersAt($next_location) || $ennemy[$next_location] > 0) $locations[$location][] = $next_location;
			}
		}
//
		return $locations;
	}
}
