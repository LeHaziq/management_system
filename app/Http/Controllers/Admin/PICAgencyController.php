<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agency;

class PICAgencyController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => '', 'label' => 'Senarai PIC'],
        ];

        return view('web.admin.pic.index', compact(
            'breadcrumbs',
        ));
    }

    public function create($agency_id)
    {
        $agency = Agency::findOrFail($agency_id);

        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.agency.pic.index'), 'label' => 'Senarai Agensi'],
            ['url' => route('admin.agency.pic.create', $agency->id), 'label' => $agency->name],
            ['url' => '', 'label' => 'Tambah PIC'],
        ];

        return view('web.admin.agency.pic.create', compact(
            'breadcrumbs',
            'agency_id',
        ));

    }

    public function edit($id)
    {

    }

    public function show($id)
    {

    }
}
