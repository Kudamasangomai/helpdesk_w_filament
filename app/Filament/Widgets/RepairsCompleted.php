<?php

namespace App\Filament\Widgets;

use App\Models\Repair;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class RepairsCompleted extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 1;

    public function getDescription(): ?string
    {
        return 'Repairs Completed / Month';
    }
    protected function getData(): array
    {
      
        $data = Trend::model(Repair::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
        return [
            'datasets' => [
                [ 
                    'label' => 'Repairs',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
