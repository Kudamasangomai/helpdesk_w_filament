<?php

namespace App\Enums;
 
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum RepairStatus: string implements HasLabel ,HasColor ,HasIcon
{

    case Open = 'Open';
    case Work_In_Progress = 'Work_In_Progress';
    case Completed = 'Completed';
    
    public function getLabel(): ?string
    {
      
    
        return match ($this) {
            self::Open => 'Open',
            self::Work_In_Progress => 'Pending',
            self::Completed => 'Completed',

        };

    }


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Open => 'danger',
            self::Work_In_Progress => 'warning',
            self::Completed => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Open => 'heroicon-m-book-open',
            self::Work_In_Progress=> 'heroicon-m-play',
            self::Completed => 'heroicon-m-check',
        };
    }

    }

