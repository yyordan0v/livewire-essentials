<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    public User $user;

    #[Validate]
    public $username = '';
    public $bio = '';


    public function rules(): array
    {
        return [
            'username' => [
                'required',
                Rule::unique('users')->ignore($this->user),
            ]
        ];
    }

    public function update(): void
    {
        $this->validate();

        $this->user->username = $this->username;
        $this->user->bio = $this->bio;

        $this->user->save();
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
        
        $this->username = $this->user->username;
        $this->bio = $this->user->bio;
    }
}
