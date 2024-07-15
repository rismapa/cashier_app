@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Nama Supplier</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $p)                       
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->code }}</td>
                                        <td>{{ $p->supplier->name }}</td>
                                        <td>{{ $p->category->name }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>Rp {{ number_format($p->price, 0, ',', ',') }}</td>
                                        <td>{{ $p->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

@endsection

