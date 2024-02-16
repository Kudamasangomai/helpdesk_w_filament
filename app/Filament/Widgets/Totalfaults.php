<?php

namespace App\Filament\Widgets;

use App\Models\fault;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Totalfaults extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // stat::make('faults',fault::query()->count())
        ];
    }
}
