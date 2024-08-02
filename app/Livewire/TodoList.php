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

    public function sort($key, $position)
    {
        $todo = $this->query()->findOrFail($key);

        $this->move($todo, $position);
    }

    public function remove($id)
    {
        $todo = $this->query()->findOrFail($id);

        $this->move($todo, 999999);

        $todo->delete();
    }

    protected function move($todo, $position)
    {
        DB::transaction(function () use ($todo, $position) {
            $current = $todo->position;
            $after = $position;

            // If there was no position change, don't shift...
            if ($current === $after) {
                return;
            }

            // Move the target todo out of the position stack...
            $todo->update(['position' => -1]);

            // Grab the shifted block and shift it up or down...
            $block = $this->query()->whereBetween('position', [
                min($current, $after),
                max($current, $after),
            ]);

            $needToShiftBlockUpBecauseDraggingTargetDown = $current < $after;

            $needToShiftBlockUpBecauseDraggingTargetDown
                ? $block->decrement('position')
                : $block->increment('position');

            // Place target back in position stack...
            $todo->update(['position' => $after]);
        });
    }

    protected function query()
    {
        return auth()->user()->todos();
    }
}
