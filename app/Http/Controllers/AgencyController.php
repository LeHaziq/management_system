<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => '', 'label' => 'Senarai Agensi']
        ];

        return view('web.admin.agency.index', compact(
            'breadcrumbs'));
    }
}
