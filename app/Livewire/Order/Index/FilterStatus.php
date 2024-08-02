<?php

namespace App\Livewire\Order\Index;

use App\Enums\Status;

enum FilterStatus: string
{
    case All = 'all';
    case Paid = Status::Paid->value;
    case Pending = Status::Pending->value;
    case Failed = Status::Failed->value;
    case Refunded = Status::Refunded->value;

    public function label()
    {
        return match ($this) {
            static::All => 'All',
            static::Paid => Status::Paid->label(),
            static::Pending => Status::Pending->label(),
            static::Failed => Status::Failed->label(),
            static::Refunded => Status::Refunded->label(),
        };
    }
}
