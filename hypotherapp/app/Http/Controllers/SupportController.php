<?php

namespace App\Http\Controllers;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index'); // Créez une vue resources/views/support/index.blade.php
    }

}
