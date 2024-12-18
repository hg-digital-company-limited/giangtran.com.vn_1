<?php

namespace App\Livewire\Content;

use Auth;
use Livewire\Component;

class ModalLogout extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.content.modal-logout');
    }
}
