@extends('layouts.main')

@section('content')
    <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            {{-- Tambah Supplier --}}
                            <a href="/add-user" class="btn btn-dark bg-primary border-0 mb-4"><i class="bx bx-plus me-1"></i> Tambah User</a>

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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @foreach ($users as $user)                       
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                <a href="/edit-user/{{ $user->id }}" class="mx-3"><i class="fas fa-pencil-alt" ></i></a>

                                                <form action="/delete-user/{{ $user->id }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="border-0" onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt" style="color: red"></i></button>
                                                </form>
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

