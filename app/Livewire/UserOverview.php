<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            stat::make('Users',User::query()->count())
        ];
    }
}
