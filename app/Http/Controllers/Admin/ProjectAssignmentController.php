<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectAssignmentController extends Controller
{
    public function index($project_id)
    {
        $project = Project::findOrFail($project_id);
        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.project.index'), 'label' => 'Senarai Projek'],
            ['url' => route('admin.project.show', $project_id), 'label' => $project->title],
            ['url' => '', 'label' => 'Penugasan Projek'],
        ];

        return view('web.admin.assignment.index', [
            'record' => $project,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
