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
}
