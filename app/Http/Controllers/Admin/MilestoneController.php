<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMilestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);

        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.project.index'), 'label' => 'Senarai Projek'],
            ['url' => route('admin.project.show', $project->id), 'label' => $project->title],
            ['url' => '', 'label' => 'Tambah Perbatuan'],
        ];

        return view('web.admin.milestone.create', compact(
            'breadcrumbs',
            'project_id',
        ));
    }

    public function edit($project_id, $milestone_id)
    {
        $project = Project::findOrFail($project_id);
        $projectMilestone = ProjectMilestone::findOrFail($milestone_id);

        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.project.index'), 'label' => 'Senarai Projek'],
            ['url' => route('admin.project.show', $project->id), 'label' => $project->title],
            ['url' => '', 'label' => 'Kemaskini Perbatuan'],
        ];

        return view('web.admin.milestone.edit', compact(
            'breadcrumbs',
            'projectMilestone',
            'project_id',
            'milestone_id'
        ));
    }

    public function show($project_id, $milestone_id)
    {
        $project = Project::findOrFail($project_id);
        $record = ProjectMilestone::findOrFail($milestone_id);

        $breadcrumbs = [
            ['url' => '', 'label' => 'Pengurusan Projek'],
            ['url' => route('admin.project.index'), 'label' => 'Senarai Projek'],
            ['url' => route('admin.project.show', $project->id), 'label' => $project->title],
            ['url' => '', 'label' => $record->title],
        ];

        return view('web.admin.milestone.show', compact(
            'breadcrumbs',
            'record',
        ));
    }
}
