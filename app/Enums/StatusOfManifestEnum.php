<?php

namespace App\Enums;

enum StatusOfManifestEnum: string
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

    public static function options(): array
    {
        return array_map(fn($status) => [
            'value' => $status->value,
            'label' => $status->label(),
        ], self::cases());
    }
}

