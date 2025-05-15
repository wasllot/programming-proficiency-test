<?php

namespace App;

class ArabicToRoman
{
    // Definición de los valores romanos como constantes
    private const ROMAN_NUMERALS = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
    ];

    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     * @throws InvalidArgumentException if the number is out of range
     */
    public static function transform(int $arabicNumber): string
    {
        // Validar el rango del número arábigo
        if ($arabicNumber < 1 || $arabicNumber > 3999) {
            throw new \InvalidArgumentException("The number must be between 1 and 3999.");
        }

        $romanNumber = '';

        // Iterar sobre los valores romanos
        foreach (self::ROMAN_NUMERALS as $value => $symbol) {
            // Mientras el número arábigo sea mayor o igual al valor
            while ($arabicNumber >= $value) {
                // Concatenar el símbolo romano
                $romanNumber .= $symbol;
                // Restar el valor del número arábigo
                $arabicNumber -= $value;
            }
        }

        return $romanNumber;
    }
}
