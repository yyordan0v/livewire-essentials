<?php

namespace App\Livewire\Order\Index;

use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Page extends Component
{
    public Store $store;

    public function render(): \Illuminate\Contracts\View\View|Factory|Application|View
    {
        return view('livewire.order.index.page');
    }
}
