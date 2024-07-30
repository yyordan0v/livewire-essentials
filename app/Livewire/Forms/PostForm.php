<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public Post $post;

    #[Validate('required|min:2')]
    public $title = '';

    #[Validate('required|min:3')]
    public $content = '';

    public function save(): void
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset(['title', 'content']);
    }

    public function update(): void
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }

    public function setPost($post): void
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }
}
