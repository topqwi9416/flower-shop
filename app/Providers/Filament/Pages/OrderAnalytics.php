<?php

namespace App\Filament\Pages;

use App\Models\Order;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;

class OrderAnalytics extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?string $navigationLabel = 'Аналитика заказов';
    protected static ?string $title = 'Аналитика заказов';
    protected static ?int $navigationSort = 2;

    protected  string $view = 'filament.pages.order-analytics';

    public string $search = '';
    public string $customer_filter = '';
    public string $status_filter = '';
    public string $sort_field = 'created_at';
    public string $sort_direction = 'desc';
    public string $date_from = '';
    public string $date_to = '';

    public function getOrders()
    {
        $query = Order::with('items')
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('customer_name', 'ilike', '%' . $this->search . '%')
                      ->orWhere('customer_phone', 'ilike', '%' . $this->search . '%')
                      ->orWhere('delivery_address', 'ilike', '%' . $this->search . '%');
                });
            })
            ->when($this->customer_filter, fn($q) =>
                $q->where('customer_name', $this->customer_filter)
            )
            ->when($this->status_filter, fn($q) =>
                $q->where('status', $this->status_filter)
            )
            ->when($this->date_from, fn($q) =>
                $q->whereDate('created_at', '>=', $this->date_from)
            )
            ->when($this->date_to, fn($q) =>
                $q->whereDate('created_at', '<=', $this->date_to)
            )
            ->orderBy($this->sort_field, $this->sort_direction);

        return $query->get();
    }

    public function getStats()
    {
        $orders = $this->getOrders();
        return [
            'total_orders' => $orders->count(),
            'total_sum'    => $orders->sum('total_amount'),
            'avg_sum'      => $orders->count() > 0
                ? round($orders->sum('total_amount') / $orders->count(), 0)
                : 0,
            'delivered'    => $orders->where('status', 'delivered')->count(),
        ];
    }

    public function getCustomers()
    {
        return Order::select('customer_name')
            ->distinct()
            ->orderBy('customer_name')
            ->pluck('customer_name');
    }

    public function sortBy(string $field)
    {
        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->customer_filter = '';
        $this->status_filter = '';
        $this->date_from = '';
        $this->date_to = '';
        $this->sort_field = 'created_at';
        $this->sort_direction = 'desc';
    }
}