<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Lottery;

trait Sortable
{
    public static function bootSortable()
    {
        static::addGlobalScope(function ($query) {
            return $query->orderBy('position');
        });

        static::creating(function ($model) {
            if ($model->sortableQuery($model)->count() === 0) {
                $model->position = 0;
            } else {
                $model->position = static::sortable($model)->max('position') + 1;
            }
        });

        static::deleting(function ($model) {
            $model->move(999999);
        });
    }

    public function move($position)
    {
        Lottery::odds(2, outOf: 100)
            ->winner(fn() => $this->arrange())
            ->choose();

        DB::transaction(function () use ($position) {
            $current = $this->position;
            $after = $position;

            // If there was no position change, don't shift...
            if ($current === $after) {
                return;
            }

            // Move the target todo out of the position stack...
            $this->update(['position' => -1]);

            // Grab the shifted block and shift it up or down...
            $block = static::sortable($this)->whereBetween('position', [
                min($current, $after),
                max($current, $after),
            ]);

            $needToShiftBlockUpBecauseDraggingTargetDown = $current < $after;

            $needToShiftBlockUpBecauseDraggingTargetDown
                ? $block->decrement('position')
                : $block->increment('position');

            // Place target back in position stack...
            $this->update(['position' => $after]);
        });
    }

    public function arrange()
    {
        DB::transaction(function () {
            $position = 0;

            foreach (static::sortable($this) as $model) {
                $model->position = $position++;

                $model->save();
            }
        });
    }
}
