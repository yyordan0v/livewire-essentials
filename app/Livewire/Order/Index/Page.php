<?php

namespace App\Livewire\Order\Index;

use App\Models\Store;
use Livewire\Component;

class Page extends Component
{
    public Store $store;

    public Filters $filters;

    public function mount()
    {
        $this->filters->init($this->store);
    }
    
    public function render()
    {
        return view('livewire.order.index.page');
    }
}
