@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="example-text-input" class="form-label">Kode Transaksi</label>
                                <input id="transaction_code" readonly value="{{ $transaction->code }}" class="form-control" name="code" type="text" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="example-text-input" class="form-label">Tanggal Transaksi</label>
                                <input id="transaction_code" readonly value="{{ $transaction->created_at->format('d-m-Y') }}" class="form-control" name="created_at" type="text" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="example-text-input" class="form-label">Kasir</label>
                                <input id="transaction_code" readonly value="{{ $transaction->user->name }}" class="form-control" name="created_at" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="example-text-input" class="form-label">Total</label>
                                <input id="transaction_code" readonly value="Rp {{ number_format($transaction->subtotal, 0, ',', ',') }}" class="form-control" name="code" type="text" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="example-text-input" class="form-label">Uang Diterima (Rp)</label>
                                <input id="transaction_code" readonly value="Rp {{ number_format($transaction->given_amount, 0, ',', ',') }}" class="form-control" name="created_at" type="text" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="example-text-input" class="form-label">Kembalian (Rp)</label>
                                <input id="transaction_code" readonly value="Rp {{ number_format($transaction->change, 0, ',', ',') }}" class="form-control" name="created_at" type="text" required>
                            </div>
                        </div>

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->product->code }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->product->price }}</td>
                                        <td>{{ $order->qty }}</td>
                                        <td>{{ $order->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

