<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class PostRow extends Component
{
    public $post;

    public PostForm $form;

    public $showEditDialog = false;

    public function mount(): void
    {
        $this->form->setPost($this->post);
    }

    public function render(): \Illuminate\Contracts\View\View|Factory|Application|View
    {
        return view('livewire.post-row', [
            'post' => $this->post,
        ]);
    }

    public function save(): void
    {
        $this->form->update();

        $this->post->refresh();

        $this->reset('showEditDialog');
    }
}
