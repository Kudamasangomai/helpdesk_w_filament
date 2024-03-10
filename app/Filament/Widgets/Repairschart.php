<?php

namespace App\Filament\Widgets;


use App\Models\Repair;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;


class Repairschart extends ChartWidget
{
    protected static ?string $heading = 'Repairs ';

    protected static ?int $sort = 1;

    protected static string $color = 'primary';

    public ?string $filter = 'today';

    public function getDescription(): ?string
    {
        return 'Repairs per Month';
    }

    protected function getFilters(): ?array
{
       $activeFilter = $this->filter;
    return [
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ];
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
        return 'line';
    }
}
