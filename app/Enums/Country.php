<?php

namespace App\Enums;

enum Country: string
{
    case United_States = 'US';
    case Brazil = 'BR';
    case Canada = 'CA';
    case Germany = 'DE';
    case France = 'FR';
    case Italy = 'IT';
    case United_Kingdom = 'UK';

    public function label(): array|string
    {
        return (string) str_replace('_', ' ', $this->name);
    }
}


