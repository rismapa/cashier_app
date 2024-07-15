<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index() {
        return view('transaction.transaction', [
            'first' => 'Kasir',
            'second' => 'Kasir',
            'third' => 'Kasir',
            'transactions' => Transaction::all(), 
        ]);
    }

    public function store() {
        $totalTransaction = Transaction::whereDate('created_at', Carbon::today())->count();
        $now = Carbon::now()->format('Y-m-d-H:i:s');
        $codeTransaction = ($totalTransaction + 1) . "-" . $now;

        $transaction = Transaction::create([
            'code' => $codeTransaction,
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'subtotal' => 0,
            'given_amount' => 0,
            'change' => 0
        ]);

        $transactionId = $transaction->id;
        $transactionCode = $transaction->code;

        // dd($transactionCode);
        return view('transaction.order', [
            'transactionId' => $transactionId,
            'transactionCode' => $transactionCode,
            'first' => 'Kasir',
            'second' => 'Kasir',
            'third' => 'Tambah Transaksi',
            'products' => Product::all(),
        ]);
        // return redirect('/add-order')->with([
        //     'transactionId' => $transactionId,
        //     'transactionCode' => $transactionCode
        // ]);
    }

    public function getProduct($id) {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'name' => $product->name,
                'price' => $product->price,
            ]);
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    public function addOrder(Request $request) {
        try {
            $productId = Product::find($request->product_id);
            $priceProduct = $productId->price;

            $order = Order::create([
                'product_id' => $request->product_id,
                'transaction_id' => $request->transaction_id,
                'qty' => $request->qty,
                'total' => $priceProduct * $request->qty,
            ]);

            return response()->json(['order' => $order, 'message' => 'Order added successfully'], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function getDataOrder($id) {
        $orders = Order::where('transaction_id', $id)->with('product')->get();

        $productItem = $orders->map(function($order) {
            return [
                'productCode' => $order->product->code,
                'productName' => $order->product->name,
                'productPrice' => $order->product->price,
                'qty' => $order->qty,
                'total' => $order->total
            ];
        });

        return response()->json([
            'productItem' => $productItem, 
        ], 200);
    }

    public function getModal($id) {
        $orders = Order::where('transaction_id', $id)->with('product')->get();

        $grandTotal = $orders->sum('total');

        return response()->json([
            'total' => $grandTotal,
        ], 200);
    }

    public function updateTransaction(Request $request, $id) {
        DB::beginTransaction();
        
        try {
            // update transaction
            $transaction = Transaction::findOrFail($id);
            $transaction->subtotal = $request->subtotal;
            $transaction->given_amount = $request->given_amount;
            $transaction->change = $request->change;
            $transaction->status = 'success';
            $transaction->save();

            // update stok
            $orders = Order::where('transaction_id', $id)->get();
            foreach($orders as $order) {
                $product = Product::findOrFail($order->product_id);
                $product->stock -= $order->qty;
                $product->save();
            }

            DB::commit();

            session()->flash('success', 'Transaksi Berhasil Ditambahkan');

            return response()->json([
                'message' => 'Transaction updated successfully!',
                'redirect' => url('/transaction'),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to update transaction.'], 500);
        }
    }

    public function show($id) {
        return view('transaction.transactionDetail', [
            'first' => 'Transaksi',
            'second' => 'Transaksi',
            'third' => 'Detail Transaksi',
            'transaction' => Transaction::findOrFail($id),
            'orders' => Order::where('transaction_id', $id)->with('product')->get(),
        ]);
    }

    public function getInvoice($id) {
        $orders = Order::where('transaction_id', $id)->with('product')->get();
        $total = $orders->sum('total');

        return view('print.invoice', [
            'transaction' => Transaction::findOrFail($id),
            'orders' => $orders,
            'total' => $total,
        ]);
    }
}
