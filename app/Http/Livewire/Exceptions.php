<?php

namespace App\Http\Livewire;

use Livewire\Component;


class Exceptions extends Component
{
    public $error_exception;

    public function mount($message)
    {
        $this->error_exception = $message;
    }

    public function render()
    {
        return view('livewire.payments.error_stripe');
    }
}
