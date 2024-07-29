<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditProfile extends Component
{
    public User $user;

    #[Validate]
    public $username = '';
    public $bio = '';

    public $showSuccessIndicator = false;

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                Rule::unique('users')->ignore($this->user),
            ]
        ];
    }

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->username = $this->user->username;
        $this->bio = $this->user->bio;
    }

    public function save(): void
    {
        $this->validate();

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
