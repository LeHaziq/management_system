<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('web.admin.project.index');
    }

    public function create()
    {
        return view('web.admin.project.create');
    }
}
