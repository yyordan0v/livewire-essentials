<?php

namespace App\Livewire\Order\Index;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Page extends Component
{
    use WithPagination;

    public Store $store;

    public $search = '';

    #[Url]
    public $sortCol;

    #[Url]
    public $sortAsc = false;

    public $selectedOrderIds = [];

    public $orderIdsOnPage = [];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

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

    public function sortBy($column): void
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = !$this->sortAsc;
        }

        $this->sortCol = $column;
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query
                ->where('email', 'like', '%'.$this->search.'%')
                ->orWhere('number', 'like', '%'.$this->search.'%');
    }

    protected function applySorting($query)
    {
        if ($this->sortCol) {
            $column = match ($this->sortCol) {
                'number' => 'number',
                'status' => 'status',
                'date' => 'ordered_at',
                'amount' => 'amount',
            };

            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }

        return $query;
    }

    public function render(): \Illuminate\Contracts\View\View|Factory|Application|View
    {
        $query = $this->store->orders();

        $this->applySearch($query);
        $this->applySorting($query);

        $orders = $query->paginate(10);

        $this->orderIdsOnPage = $orders->map(fn($order) => (string) $order->id)->toArray();

        return view('livewire.order.index.page', [
            'orders' => $orders,
        ]);
    }
}
