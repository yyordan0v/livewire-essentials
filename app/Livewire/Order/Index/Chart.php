<?php

namespace App\Livewire\Order\Index;

use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

class Chart extends Component
{
    public Store $store;
    public $dataset = [];

    public function mount(): void
    {
        $this->fillDataset();
    }

    public function fillDataset(): void
    {
        $results = $this->store->orders()
            ->select(
                DB::raw("strftime('%Y', ordered_at) || '-' || strftime('%m', ordered_at) as increment"),
                DB::raw('SUM(amount) as total'),
            )
            ->groupBy('increment')
            ->get();

        $this->dataset['values'] = $results->pluck('total')->toArray();
        $this->dataset['labels'] = $results->pluck('increment')->toArray();
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.order.index.chart');
    }
}
