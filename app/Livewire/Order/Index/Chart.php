<?php

namespace App\Livewire\Order\Index;

use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Chart extends Component
{
    public Store $store;

    #[Reactive]
    public Filters $filters;

    public $dataset = [];

    public function fillDataset()
    {
        $increment = match ($this->filters->range) {
            Range::Today => "strftime('%H', ordered_at) as increment",
            Range::Year, Range::All_Time => "strftime('%Y', ordered_at) || '-' || strftime('%m', ordered_at) as increment",
            default => "DATE(ordered_at) as increment",
        };

        $results = $this->store->orders()
            ->select(
                DB::raw($increment),
                DB::raw('SUM(amount) as total'),
            )
            ->tap(function ($query) {
                $this->filters->apply($query);
            })
            ->groupBy('increment')
            ->get();

        $this->dataset['values'] = $results->pluck('total')->toArray();
        $this->dataset['labels'] = $results->pluck('increment')->toArray();
    }

    public function render()
    {
        $this->fillDataset();

        return view('livewire.order.index.chart');
    }

    public function placeholder()
    {
        return view('livewire.order.index.chart-placeholder');
    }
}
