<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class EditProfile extends Component
{
    public User $user;
    public $username = '';
    public $bio = '';

    public $showSuccessIndicator = false;


    public function mount(): void
    {
        $this->user = auth()->user();
        $this->username = $this->user->username;
        $this->bio = $this->user->bio;
    }

    public function save(): void
    {
        $this->user->username = $this->username;
        $this->user->bio = $this->bio;

        $this->user->save();

        sleep(1);

        $this->showSuccessIndicator = true;
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.edit-profile');
    }
}
