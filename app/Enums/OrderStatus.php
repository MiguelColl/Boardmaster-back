<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PAID = 1;
    case CANCELED = 2;
    case PREPARING = 3;
    case SENT = 4;
    case COMPLETED = 5;
}
