<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek']
        ];

        return view('web.admin.project.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['url' => route('admin.project.index'), 'label' => 'Pengurusan Projek'],
            ['url' => '', 'label' => 'Tambah Projek'],
        ];

        return view('web.admin.project.create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function edit($id)
    {
        $breadcrumbs = [
            ['url' => route('admin.project.index'), 'label' => 'Pengurusan Projek'],
            ['url' => '', 'label' => 'Tambah Projek'],
        ];

        $project = Project::findOrFail($id);
        return view('web.admin.project.edit', [
            'breadcrumbs' => $breadcrumbs,
            'project' => $project,
        ]);
    }
}
