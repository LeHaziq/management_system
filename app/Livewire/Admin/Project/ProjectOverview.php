<?php

namespace App\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\Intern;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $project = Project::where('status', 'Berjaya')->count();
        $intern = Intern::where('status', 'Aktif')->count();

        return [
            Stat::make('Projek Aktif', $project)
                ->icon('heroicon-m-arrow-trending-up')
                ->color('danger'),
            Stat::make('Pelatih Industri', $intern)
                ->icon('heroicon-m-users'),
        ];
    }
}
