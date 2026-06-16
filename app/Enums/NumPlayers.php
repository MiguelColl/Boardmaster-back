<?php

namespace App\Enums;

enum NumPlayers: string
{
    case ONE = '1';
    case TWO = '2';
    case THREE_FOUR = '3-4';
    case FIVE_PLUS = '5-plus';
}
