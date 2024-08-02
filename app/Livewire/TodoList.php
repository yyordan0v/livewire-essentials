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
        return $this->query()->get();
    }

    public function add()
    {
        $this->query()->create([
            'name' => $this->pull('draft'),
        ]);
    }

    public function sort($key, $position)
    {
        $this->query()->findOrFail($key)->move($position);
    }

    public function remove($id)
    {
        $this->query()->findOrFail($id)->delete();
    }


    protected function query()
    {
        return auth()->user()->todos();
    }
}
