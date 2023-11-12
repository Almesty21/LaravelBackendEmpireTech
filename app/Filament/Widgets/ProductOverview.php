<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProductOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Products Less than 1000$', Product::query()->where('price', '<', 1000)->count()),
            Stat::make('Total Products', Product::query()->count()),
            Stat::make('Total Categories', Category::query()->count()),
        ];
    }
}
