<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // dd(auth()->user()->getRoleNames());

        return view('layouts.main');
    }
}
