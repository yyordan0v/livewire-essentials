<?php

namespace App\Livewire\Order\Index;

use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;
    
    public Store $store;

    public function render(): \Illuminate\Contracts\View\View|Factory|Application|View
    {
        sleep(1);

        return view('livewire.order.index.page', [
            'orders' => $this->store->orders()->paginate(10),
        ]);
    }
}
