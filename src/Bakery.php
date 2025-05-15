<?php

namespace App;

use InvalidArgumentException;

class Bakery
{
    /**
     * Calculate the output of cakes for a given recipe
     *
     * @param array $recipe      Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return int The number of cakes you can bake
     * @throws InvalidArgumentException if the recipe or ingredients are invalid
     */
    public static function calculateOutput(array $recipe, array $ingredients): int
    {
        // Validar que la receta y los ingredientes no estén vacíos
        if (empty($recipe) || empty($ingredients)) {
            throw new InvalidArgumentException("Recipe and ingredients must not be empty.");
        }

        // Inicializar el número de pasteles a un número muy alto
        $numberOfCakes = PHP_INT_MAX;

        // Iterar sobre cada ingrediente en la receta
        foreach ($recipe as $ingredient => $amountNeeded) {
            // Verificar si el ingrediente está disponible
            if (!isset($ingredients[$ingredient])) {
                // Si falta un ingrediente, no se pueden hacer pasteles
                return 0;
            }

            // Verificar que la cantidad necesaria sea positiva
            if ($amountNeeded <= 0) {
                throw new InvalidArgumentException("Amount needed for ingredient '$ingredient' must be positive.");
            }

            // Calcular cuántos pasteles se pueden hacer con el ingrediente actual
            $amountAvailable = $ingredients[$ingredient];
            $cakesWithCurrentIngredient = floor($amountAvailable / $amountNeeded);

            // Tomar el mínimo de los pasteles que se pueden hacer
            $numberOfCakes = min($numberOfCakes, $cakesWithCurrentIngredient);
        }

        return $numberOfCakes;
    }
}