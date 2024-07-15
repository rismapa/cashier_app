@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- Tambah Transaction --}}
                    <a href="/add-transaction" class="btn btn-dark bg-primary border-0 mb-4"><i class="bx bx-plus me-1"></i> Tambah Transaksi</a>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show col-6" role="alert">
                            <i class="mdi mdi-check-all label-icon"></i><strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- <div class="table-responsive">
                        <table class="table align-middle datatable dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 120px;">Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th style="width: 150px;">Download Invoice</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-body fw-medium">{{ $transaction->code }}</td>
                                        <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>Rp {{ number_format($transaction->subtotal, 0, ',', ',') }}</td>
                                        <td>
                                            <span class="badge fs-12 {{ $transaction->status == 'success' ? 'badge-soft-success' : 'badge-soft-warning' }}">{{ $transaction->status }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="/get-invoice/{{ $transaction->id }}" target="_blank" type="button" class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light"><i class="bx bx-download label-icon"></i> Pdf</a>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="/transaction-detail/{{ $transaction->id }}">Lihat</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Status</th>
                                <th>Sub Total</th>
                                <th>Download Invoice</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->code }}</td>
                                    <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>
                                        <span class="badge fs-12 {{ $transaction->status == 'success' ? 'badge-soft-success' : 'badge-soft-warning' }}">{{ $transaction->status }}</span>
                                    </td>
                                    <td>Rp {{ number_format($transaction->subtotal, 0, ',', ',') }}</td>
                                    <td>
                                        <div>
                                            <a href="/get-invoice/{{ $transaction->id }}" target="_blank" type="button" class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light"><i class="bx bx-download label-icon"></i> Pdf</a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/transaction-detail/{{ $transaction->id }}" class="btn btn-dark bg-primary border-0 align-center"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

