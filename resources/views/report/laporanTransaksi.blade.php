@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/download-transaction" method="get" target="_blank">
                            @csrf
                            <div class="row align-items-end mb-3">
                                <div class="col-lg-4 mb-3">
                                    <label for="example-date-input" class="form-label">Mulai Tanggal</label>
                                    <input class="form-control" type="date" name="start_date" required>
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="example-date-input" class="form-label">Sampai Tanggal</label>
                                    <input class="form-control" type="date" name="end_date" required>
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-3 my-3 text-align-center">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Download</button>
                                </div>
                            </div>
                        </form>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Kasir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                               @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->code }}</td>
                                        <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>Rp {{ number_format($transaction->subtotal, 0, ',', ',') }}</td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

@endsection

