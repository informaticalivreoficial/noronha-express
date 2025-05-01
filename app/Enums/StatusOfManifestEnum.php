<?php

namespace App\Enums;

enum Status: string
{
    case Recebido = 'recebido';
    case Carregando = 'carregando';
    case Transito = 'transito';
    case Descarregando = 'descarregando';
    case Entregue = 'entregue';

    public function label(): string
    {
        return match ($this) {
            self::Recebido => 'Recebido',
            self::Carregando => 'Carregando',
            self::Transito => 'Trânsito',
            self::Descarregando => 'Descarregando',
            self::Entregue => 'Entregue',
        };
    }
}

