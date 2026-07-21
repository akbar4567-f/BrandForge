<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    // Dashboard Owner
    public function index()
    {
        return view('owner.index');
    }

}