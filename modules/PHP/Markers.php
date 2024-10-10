<?php

/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
class Markers extends APP_GameClass
{
	static function create(string $type, string $location): int
	{
		self::DbQuery("INSERT INTO markers (type,location) VALUES ('$type','$location')");
		return self::DbGetLastId();
	}
	static function destroy(int $id): void
	{
		self::DbQuery("DELETE FROM markers WHERE id = $id");
	}
	static function getAllDatas(): array
	{
		return self::getCollectionFromDB("SELECT * FROM markers ORDER BY type");
	}
	static function getAt(string $location): array
	{
		return self::getCollectionFromDB("SELECT * FROM markers WHERE location = '$location' ORDER BY type");
	}
}
