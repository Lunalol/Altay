<?php
/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */

namespace Bga\Games\ALTAY;

class Resources extends \APP_GameClass
{
	static function create(string $type, string $location): int
	{
		self::DbQuery("INSERT INTO resources (type,location) VALUES ('$type','$location')");
		return self::DbGetLastId();
	}
	static function destroy(int $id): void
	{
		self::DbQuery("DELETE FROM resources WHERE id = $id");
	}
	static function getAllDatas(): array
	{
		return self::getCollectionFromDB("SELECT * FROM resources ORDER BY type");
	}
	static function get(int $id): array
	{
		return self::getObjectListFromDB("SELECT * FROM resources WHERE id = $id")[0];
	}
	static function getAt(string $location, string|null $type = null): array
	{
		if ($type) return self::getCollectionFromDB("SELECT * FROM resources WHERE location = '$location' WHERE type = '$type'");
		return self::getCollectionFromDB("SELECT * FROM resources WHERE location = '$location' ORDER BY type");
	}
}
