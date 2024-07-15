@extends('layouts.main')

@section('content')
    <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show col-6" role="alert">
                                    <i class="mdi mdi-check-all label-icon"></i><strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/edit-profil/{{ Auth::user()->id }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Nama</label>
                                            <input value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Masukan Nama" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Username</label>
                                            <input value="{{ Auth::user()->username }}" class="form-control @error('username') is-invalid @enderror" name="username" type="text" placeholder="Masukan Username" required>
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror" name="password" type="text" placeholder="Masukan password" required>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Ubah</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        

    </div>
@endsection

