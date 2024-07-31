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

    public $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query
                ->where('email', 'like', '%'.$this->search.'%')
                ->orWhere('number', 'like', '%'.$this->search.'%');
    }

    public function render(): \Illuminate\Contracts\View\View|Factory|Application|View
    {
        $query = $this->store->orders();

        $this->applySearch($query);

        return view('livewire.order.index.page', [
            'orders' => $query->paginate(10),
        ]);
    }
}
