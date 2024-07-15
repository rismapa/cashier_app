@extends('layouts.main')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="/add-user" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Masukan Nama" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" placeholder="Masukan Username" required>
                                @error('username')
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

