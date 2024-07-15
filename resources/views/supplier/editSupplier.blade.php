@extends('layouts.main')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="/edit-supplier/{{ $supplier->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Supplier</label>
                                <input value="{{ $supplier->name }}" class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Masukan Supplier" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Nomor Telpon</label>
                                <input value="{{ $supplier->phone }}" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" placeholder="Masukan Nomor Telpon Supplier" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" value="{{ $supplier->address }}" name="address" id="" cols="25" rows="5" placeholder="Masukan Alamat Supplier" required></textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror 
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
    
@endsection

