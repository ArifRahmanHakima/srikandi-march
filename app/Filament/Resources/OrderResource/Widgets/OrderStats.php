<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pesanan Baru', Order::query()->where('status', 'new')->count()),
            Stat::make('Pesanan Diproses', Order::query()->where('status', 'processing')->count()),
            Stat::make('Pesanan Dikirim', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Total Pembayaran', 'Rp ' . number_format(Order::query()->sum('grand_total') ?? 0, 0, ',', '.')),
        ];
    }
}
