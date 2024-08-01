<?php

namespace App\Livewire\Order\Index;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, Sortable, Searchable;

    public Store $store;

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


    public function render(): \Illuminate\Contracts\View\View|Factory|Application|View
    {
        $query = $this->store->orders();

        $this->applySearch($query);
        $this->applySorting($query);

        $orders = $query->paginate(10);

        $this->orderIdsOnPage = $orders->map(fn($order) => (string) $order->id)->toArray();

        return view('livewire.order.index.table', [
            'orders' => $orders,
        ]);
    }

    public function placeholder(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.order.index.table-placeholder');
    }
}
