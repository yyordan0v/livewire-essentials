<?php

namespace App\Livewire\Order\Index;

use App\Models\Store;
use Livewire\Form;

class Filters extends Form
{
    public Store $store;

    public $selectedProductIds = [];

    public function init($store)
    {
        $this->store = $store;

        $this->selectedProductIds = $this->products()->pluck('id')->toArray();
    }

    public function products()
    {
        return $this->store->products;
    }

    public function apply($query)
    {
        return $query->whereIn('product_id', $this->selectedProductIds);
    }
}
