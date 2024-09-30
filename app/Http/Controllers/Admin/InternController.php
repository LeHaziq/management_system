<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Industri'],
            ['url' => '', 'label' => 'Senarai Pelatih Industri'],
        ];

        return view('web.admin.intern.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Industri'],
            ['url' => route('admin.intern.index'), 'label' => 'Senarai Pelatih Industri'],
            ['url' => '', 'label' => 'Tambah Pelatih'],
        ];

        return view('web.admin.intern.create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
