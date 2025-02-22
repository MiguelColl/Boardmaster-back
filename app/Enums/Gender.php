<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'Hombre';
    case FEMALE = 'Mujer';
    case NO_BINARY = 'No binario';
    case NO_SPECIFIED = 'No especificado';
}
