<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
        return view('web.public.index');
    }
}
