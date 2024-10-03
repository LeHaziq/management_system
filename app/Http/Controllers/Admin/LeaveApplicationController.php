<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
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

    public function create()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Industri'],
            ['url' => route('admin.leave.index'), 'label' => 'Senarai Permohonan Cuti'],
            ['url' => '', 'label' => 'Tambah Permohonan Cuti'],
        ];

        return view('web.admin.leave.create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function edit($id)
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Industri'],
            ['url' => route('admin.leave.index'), 'label' => 'Senarai Permohonan Cuti'],
            ['url' => '', 'label' => 'Kemaskini Permohonan Cuti'],
        ];

        $leaveApplication = LeaveApplication::findOrFail($id);

        return view('web.admin.leave.edit', [
            'breadcrumbs' => $breadcrumbs,
            'leaveApplication' => $leaveApplication,
        ]);
    }

    public function show($id)
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Industri'],
            ['url' => route('admin.leave.index'), 'label' => 'Senarai Permohonan Cuti'],
            ['url' => '', 'label' => $leaveApplication->intern->name],
        ];

        return view('web.admin.leave.show', [
            'breadcrumbs' => $breadcrumbs,
            'record' => $leaveApplication,
        ]);
    }
}
