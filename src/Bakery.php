<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

final class Bakery
{
    public static function calculateOutput(array $recipe, array $ingredients): int
    {
        return match (true) {
            empty($recipe) || empty($ingredients) => throw new InvalidArgumentException(
                'Recipe and ingredients must not be empty.'
            ),
            default => self::computeCakes($recipe, $ingredients)
        };
    }

    private static function computeCakes(array $recipe, array $ingredients): int
    {
        $firstIngredient = array_key_first($recipe);
        $initialCakes = floor($ingredients[$firstIngredient] / $recipe[$firstIngredient]);

        return array_reduce(
            array_keys($recipe),
            function (int $minCakes, string $ingredient) use ($recipe, $ingredients): int {
                if (!isset($ingredients[$ingredient])) {
                    return 0;
                }

                $amountNeeded = $recipe[$ingredient];
                if ($amountNeeded <= 0) {
                    throw new InvalidArgumentException(
                        "Amount needed for ingredient '{$ingredient}' must be positive."
                    );
                }

                return min($minCakes, (int)floor($ingredients[$ingredient] / $amountNeeded));
            },
            (int)$initialCakes
        );
    }
}