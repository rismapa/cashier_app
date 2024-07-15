<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportTransaction() {
        return view('report.laporanTransaksi', 
            [
                'first' => 'Laporan',
                'second' => 'Laporan',
                'third' => 'Laporan Penjualan',
                'transactions' => Transaction::where('status', 'success')->get(),
            ]
        );
    }

    public function downloadTransaction(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $now = Carbon::now();

        $orders = Order::whereDate('created_at', '>=', $start_date)
                        ->whereDate('created_at', '<=', $end_date)
                        ->whereHas('transaction', function($query) {
                            $query->where('status', 'success');
                        })
                        ->with('product', 'transaction')
                        ->get();

        $sum = Transaction::where('created_at', '>=', $start_date)
                            ->where('created_at', '<=', $end_date)
                            ->sum('subtotal');

        $countTransction = Transaction::where('created_at', '>=', $start_date)
                                    ->where('created_at', '<=', $end_date)
                                    ->where('status', 'success')
                                    ->get();
        $count = count($countTransction);

        $productCount = Order::whereDate('created_at', '>=', $start_date)
                            ->whereDate('created_at', '<=', $end_date)
                            ->whereHas('transaction', function($query) {
                                $query->where('status', 'success');
                            })
                            ->with('transaction')
                            ->sum('qty');

        // dd($start_date);
        return view('print.downloadTransaksi',
        [
            'start_date' => strftime("%e %B %Y", strtotime($start_date)),
            'end_date' => strftime("%e %B %Y", strtotime($end_date)),
            'now' => strftime("%e %B %Y", strtotime($now)),
            'orders' => $orders,
            'sum' => $sum,
            'countTransaction' => $count,
            'countProduct' => $productCount,
        ]);
    }
}
