<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gcash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MedicalRecord;

class ChartController extends Controller
{
    public function _Chart(Request $request)
    {
        $entries =  Gcash::select(
            // DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total_price'),
            DB::raw('COUNT(*) as count'),
        )
            ->groupBy('month')
            ->orderBy('month')
            ->where('status', 1)
            ->get();

        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        $total = $count = [];

        foreach ($entries as $entry) {
            $total[$entry->month] = $entry->total_price;
            $count[$entry->month] = $entry->count;
        }

        foreach ($labels as $month => $name) {
            if (!array_key_exists($month, $total)) {
                $total[$month] = 0;
            }

            if (!array_key_exists($month, $count)) {
                $count[$month] = 0;
            }
        }

        ksort($total);
        ksort($count);

        return [
            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Totals ₱',
                    'data' => array_values($total),
                ],
                [
                    'label' => 'Users subscribe #',
                    'data' => array_values($count),
                ],

            ],
        ];
    }

    public function _medical(Request $request)
    {

        $entries =  MedicalRecord::select(
            // DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(cost) as total_price'),
            DB::raw('COUNT(*) as count'),
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        $total = $count = [];

        foreach ($entries as $entry) {
            $total[$entry->month] = $entry->total_price;
            $count[$entry->month] = $entry->count;
        }

        foreach ($labels as $month => $name) {
            if (!array_key_exists($month, $total)) {
                $total[$month] = 0;
            }

            if (!array_key_exists($month, $count)) {
                $count[$month] = 0;
            }
        }

        ksort($total);
        ksort($count);

        return [
            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Totals ₱',
                    'data' => array_values($total),
                ],
                [
                    'label' => 'Total Patients #',
                    'data' => array_values($count),
                ],

            ],
        ];
    }

    public function newBooks()
    {
        $book = Booking::where('status', 'Pending')->count();
        return response()->json(['data' => $book]);
    }
}
