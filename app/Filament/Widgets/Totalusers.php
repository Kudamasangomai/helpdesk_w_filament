<?php

namespace App\Filament\Widgets;

use App\Models\asset;
use App\Models\User;
use App\Models\fault;
use App\Models\Repair;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class Totalusers extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            stat::make('repairs',Repair::query()->count()),
            stat::make('Users',User::query()->count()),
            stat::make('faults',fault::query()->count()),
            stat::make('assets',asset::query()->count()),
        
        ];
    }
}
