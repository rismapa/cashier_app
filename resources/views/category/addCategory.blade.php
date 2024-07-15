@extends('layouts.main')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="/add-category" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Kategori</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Masukan Kode Kategori" required>
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Kategori</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Masukan Kategori Produk" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

