<?php

namespace App\Enums;

enum Shipment
{
    case FREE;
    case REDUCED;
    case FULL;

    public function value(): float
    {
        return match($this) {
            self::FREE => 0,
            self::REDUCED => 2.99,
            self::FULL => 5.99,
        };
    }
}
