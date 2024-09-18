<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
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

    public function edit($id)
    {
        $agency = Agency::findOrFail($id);
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.agency.index'), 'label' => 'Senarai Agensi'],
            ['url' => '', 'label' => 'Kemaskini Agensi'],
        ];

        return view('web.admin.agency.edit', [
            'breadcrumbs' => $breadcrumbs,
            'agency' => $agency,
        ]);
    }

    public function show($id)
    {
        $agency = Agency::findOrFail($id);
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.agency.index'), 'label' => 'Senarai Agensi'],
            ['url' => '', 'label' => $agency->name],
        ];

        return view('web.admin.agency.show', [
            'breadcrumbs' => $breadcrumbs,
            'record' => $agency,
        ]);
    }
}
