<?php

namespace App\Enums;

enum PhotoStatusEnum : string
{
    case PENDENTE = 'pendente';
    case APROVADO = 'aprovado';
    case REJEITADO = 'rejeitado';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
