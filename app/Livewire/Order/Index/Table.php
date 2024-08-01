<?php

namespace App\Livewire\Order\Index;

use App\Models\Order;
use App\Models\Store;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, Sortable, Searchable;

    public Store $store;

    #[Reactive]
    public Filters $filters;

    public $selectedOrderIds = [];

    public $orderIdsOnPage = [];

    public function refund(Order $order): void
    {
        $this->authorize('update', $order);

        $order->refund();
    }

    public function refundSelected(): void
    {
        $orders = $this->store->orders()->whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $this->refund($order);
        }
    }

    public function archive(Order $order): void
    {
        $this->authorize('update', $order);

        $order->archive();
    }

    public function archiveSelected(): void
    {
        $orders = $this->store->orders()->whereIn('id', $this->selectedOrderIds)->get();

        foreach ($orders as $order) {
            $this->archive($order);
        }
    }

    #[Renderless]
    public function export()
    {
        return $this->store->orders()->toCsv();
    }


    public function render()
    {
        $query = $this->store->orders();

        $query = $this->applySearch($query);
        $query = $this->applySorting($query);
        $query = $this->filters->apply($query);

        $orders = $query->paginate(10);

        $this->orderIdsOnPage = $orders->map(fn($order) => (string) $order->id)->toArray();

        return view('livewire.order.index.table', [
            'orders' => $orders,
        ]);
    }

    public function placeholder()
    {
        return view('livewire.order.index.table-placeholder');
    }
}
