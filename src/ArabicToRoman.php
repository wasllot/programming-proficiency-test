<?php

declare(strict_types=1);

namespace App;

final class ArabicToRoman
{
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

    public static function transform(int $arabicNumber): string
    {
        return match (true) {
            $arabicNumber < 1 || $arabicNumber > 3999 => throw new \InvalidArgumentException(
                "The number must be between 1 and 3999."
            ),
            default => self::convertToRoman($arabicNumber)
        };
    }

    private static function convertToRoman(int $number): string
    {
        return array_reduce(
            array_keys(self::ROMAN_NUMERALS),
            fn(string $result, int $value): string => $result . str_repeat(
                self::ROMAN_NUMERALS[$value],
                ($count = intdiv($number, $value)) && ($number %= $value) ? $count : 0
            ),
            ''
        );
    }
}
