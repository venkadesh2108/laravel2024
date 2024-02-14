<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        return view('billing');
    }

    public function index()
    {
        return view('viewbills');
    }

    public function view()
    {
        return view('mysql');
    }

}
