<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class ShowPosts extends Component
{
    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.show-posts', [
            'posts' => Post::all(),
        ]);
    }

    public function delete($postId): void
    {
        $post = Post::find($postId);

        //authorize ...

        $post->delete();

        sleep(1);
    }
}
