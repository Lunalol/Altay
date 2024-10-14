<?php

/**
 *
 * @author Lunalol - PERRIN Jean-Luc
 *
 */
class Board extends APP_GameClass
{
//
// Regions (44)
//
	const REGIONS = [
		0 => FARMLAND, 1 => FARMLAND, 2 => FARMLAND, 3 => FARMLAND, 4 => FARMLAND, 5 => FARMLAND,
		6 => FOREST, 7 => FOREST, 8 => FOREST, 9 => FOREST, 10 => FOREST, 11 => FOREST,
		12 => HILL, 13 => HILL, 14 => HILL, 15 => HILL, 16 => HILL, 17 => HILL,
		18 => MOUNTAIN, 19 => MOUNTAIN, 20 => MOUNTAIN, 21 => MOUNTAIN, 22 => MOUNTAIN,
		23 => FARMLAND, 24 => FARMLAND,
	];
	const ADJACENCY = [
		0 => [6, 12, 13],
		1 => [7, 20, 13],
		2 => [7, 8, 14],
		3 => [9, 16, 18],
		4 => [15, 16, 22],
		5 => [11, 17, 21],
		6 => [0, 12, 13, 18],
		7 => [1, 2, 13, 14, 20],
		8 => [2, 14, 21],
		9 => [3, 4, 15, 16, 18],
		10 => [17, 21],
		11 => [5, 17, 22],
		12 => [0, 6, 18],
		13 => [0, 1, 6, 7, 19],
		14 => [2, 7, 8],
		15 => [4, 9, 18, 19],
		16 => [3, 4, 9, 22],
		17 => [5, 10, 11, 21, 22],
		18 => [3, 6, 9, 12, 15],
		19 => [13, 15],
		20 => [1, 7],
		21 => [8, 10, 5, 17],
		22 => [4, 11, 16, 17],
	];
//
	static function settlements(string $faction): array
	{
		$locations = [];
//
		foreach (array_keys(self::REGIONS) as $location)
		{
			$tokens = Tokens::getAt($location);
//
			$self[$location] = sizeof(array_filter($tokens, fn($token) => $token['type'] === $faction));
			$ennemy[$location] = sizeof(array_filter($tokens, fn($token) => $token['type'] !== $faction));
		}
//
		foreach (array_keys(self::REGIONS) as $location)
		{
			if ($self[$location] > 0 && $ennemy[$location] === 0)
			{
				if ($self[$location] < 4) $locations[] = $location;
				foreach (self::ADJACENCY[$location] as $next_location) if (!Markers::getAt($next_location) && $self[$next_location] === 0 && $ennemy[$next_location] === 0) $locations[] = $next_location;
			}
		}
//
		return $locations;
	}
}
