<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Repair;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
// not working
class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // stat::make('Users',User::query()->count()),
            // stat::make('Repairs',Repair::query()->count())
        ];
    }
}
