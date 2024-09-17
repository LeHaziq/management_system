<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function create()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.agency.index'), 'label' => 'Senarai Agensi'],
            ['url' => '', 'label' => 'Tambah Agensi'],
        ];

        return view('web.admin.agency.create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
