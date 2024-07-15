@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        {{-- Tambah Barang --}}
                        <a href="/add-product" class="btn btn-dark bg-primary border-0 mb-4"><i class="bx bx-plus me-1"></i> Tambah Barang</a>

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show col-6" role="alert">
                                <i class="mdi mdi-check-all label-icon"></i><strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Supplier</th>
                                    <th>Kategori</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $p)                       
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->supplier->name }}</td>
                                        <td>{{ $p->category->name }}</td>
                                        <td>{{ $p->code }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td id="price">Rp {{ number_format($p->price, 0, ',', ',') }}</td>
                                        <td>{{ $p->stock }}</td>
                                        <td>
                                            <a href="/edit-product/{{ $p->id }}" class="mx-3"><i class="fas fa-pencil-alt" ></i></a>

                                            {{-- <form action="/delete-supplier/{{ $supplier->id }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="border-0" onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt" style="color: red"></i></button>
                                            </form> --}}
                                        </td>
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

