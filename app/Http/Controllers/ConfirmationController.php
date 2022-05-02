<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function confirmation(){
        return view('confirmation');
    }
}