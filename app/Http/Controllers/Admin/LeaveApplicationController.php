<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Industri'],
            ['url' => '', 'label' => 'Permohonan Cuti'],
        ];
        
        return view('web.admin.leave.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
