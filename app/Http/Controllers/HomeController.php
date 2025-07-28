<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // إجمالي الفواتير
        $total_buy = invoices::sum('total_buy');
        $total_count = invoices::count();

        // إجمالي المتبقي (باقي الفواتير)
        $total_remain = invoices::whereIn('status', [2,3])->sum('total_remain');
        $remain_count = invoices::whereIn('status', [2,3])->count();

        // إجمالي المدفوع (للفواتير المتبقية وغير المدفوعة)
        $total_paid = invoices::whereIn('status', [2,3])->sum('total_buy') - invoices::whereIn('status', [2,3])->sum('total_remain');

        // Chart 1: Bar chart for sums
        $chartjs = app()->chartjs
            ->name('barChartSums')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['اجمالي الفواتير', 'اجمالي المتبقي', 'اجمالي المدفوع'])
            ->datasets([
                [
                    "label" => "المبالغ",
                    'backgroundColor' => ['#007bff', '#dc3545', '#28a745'],
                    'data' => [$total_buy, $total_remain, $total_paid]
                ]
            ])
            ->options([]);

        // Chart 2: Pie chart for counts
        $chartjs_2 = app()->chartjs
            ->name('pieChartCounts')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['كل الفواتير', 'باقي الفواتير', 'المدفوعة من الباقي'])
            ->datasets([
                [
                    'backgroundColor' => ['#007bff', '#dc3545', '#28a745'],
                    'data' => [$total_count, $remain_count, $total_paid > 0 ? 1 : 0]
                ]
            ])
            ->options([]);

        return view('home', compact('chartjs', 'chartjs_2'));
    }
}
