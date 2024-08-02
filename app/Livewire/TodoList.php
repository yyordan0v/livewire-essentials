<?php

namespace App\Livewire;

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

    protected function query()
    {
        return auth()->user()->todos();
    }
}
