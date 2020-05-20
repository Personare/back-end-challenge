<?php declare(strict_types = 1);

namespace App\Entity\Currency;

class Factory
{
    /** @var array<string, string> */
    protected static array $types = [
        'USD' => Dollar::class,
        'BRL' => Real::class,
        'EUR' => Euro::class,
    ];

    public static function create(string $type): ICurrency
    {
        if (!isset(self::$types[$type])) {
            throw new \InvalidArgumentException(
                "A moeda \"{$type}\" não existe em nossa API de conversão!",
            );
        }

        return new self::$types[$type];
    }
}
