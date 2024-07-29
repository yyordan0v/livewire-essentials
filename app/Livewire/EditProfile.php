<?php

namespace App\Livewire;

use App\Livewire\Forms\ProfileForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class EditProfile extends Component
{
    public ProfileForm $form;

    public $showSuccessIndicator = false;

    public function mount(): void
    {
        $this->form->setUser(auth()->user());
    }

    public function save(): void
    {
        $this->form->update();

        sleep(1);

        $this->showSuccessIndicator = true;
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.edit-profile');
    }
}
