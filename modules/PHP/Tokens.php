<?php

/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
class Tokens extends APP_GameClass
{
	static function create(string $type, string $location): int
	{
		self::DbQuery("INSERT INTO tokens (type,location) VALUES ('$type','$location')");
		return self::DbGetLastId();
	}
	static function destroy(int $id): void
	{
		self::DbQuery("DELETE FROM tokens WHERE id = $id");
	}
	static function getAllDatas(): array
	{
		return self::getCollectionFromDB("SELECT * FROM tokens ORDER BY type");
	}
	static function get(int $id): array
	{
		return self::getObjectListFromDB("SELECT * FROM tokens WHERE id = $id")[0];
	}
}
