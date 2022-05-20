<?php

namespace App\Http\Livewire;

use Livewire\Component;


class Exceptions extends Component
{
    public $error_exception;
    public $promoter_code;

    public function mount($message, $code=null)
    {
        $this->error_exception = $message;
        $this->promoter_code = $code;
    }

    public function render()
    {
        return view('livewire.payments.error_stripe');
    }
}
