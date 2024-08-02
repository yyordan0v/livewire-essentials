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
        return auth()->user()->todos;
    }

    public function add()
    {
        auth()->user()->todos()->create([
            'name' => $this->pull('draft'),
        ]);
    }
}
