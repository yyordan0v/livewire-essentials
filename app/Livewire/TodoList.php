<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TodoList extends Component
{
    public $draft = '';

    #[Computed]
    public function todos()
    {
        return $this->query()->orderBy('position')->get();
    }

    public function add()
    {
        $this->query()->create([
            'name' => $this->pull('draft'),
            'position' => $this->query()->max('position') + 1,
        ]);
    }

    public function sort($item, $position)
    {
        $todo = $this->query()->findOrFail($item);

        DB::transaction(function () use ($todo, $position) {
            $current = $todo->position;
            $after = $position;

            if ($current == $after) {
                return;
            }

            $todo->update(['position' => -1]);

            $block = $this->query()->whereBetween('position', [
                min($current, $after),
                max($current, $after),
            ]);

            $needToShiftBlockUpBecauseDraggingTargetDown = $current < $after;

            $needToShiftBlockUpBecauseDraggingTargetDown
                ? $block->decrement('position')
                : $block->increment('position');

            $todo->update(['position' => $after]);
        });
    }

    protected function query()
    {
        return auth()->user()->todos();
    }
}
