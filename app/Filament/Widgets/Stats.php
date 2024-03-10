<?php

namespace App\Filament\Widgets;

use App\Models\asset;
use App\Models\User;
use App\Models\fault;
use App\Models\Repair;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Stats extends BaseWidget
{


    protected function getStats(): array
    {
        return [
            stat::make('',Repair::query()->count())
            ->description('Repairs')
            ->descriptionIcon('heroicon-m-wrench')
            ->chart([15, 15, 15])
            ->color('success'),
       
           
            stat::make('Users',User::query()->count())
            ->description('Users')
            ->descriptionIcon('heroicon-m-wrench')
            ->chart([15, 15, 15])
            ->color('info'),


            stat::make('Faults',fault::query()->count())
            ->description('Faults')
            ->descriptionIcon('heroicon-m-wrench')
            ->chart([15, 15, 15])
            ->color('warning'),

            stat::make('Assets',asset::query()->count()),
        ];
    }
}
