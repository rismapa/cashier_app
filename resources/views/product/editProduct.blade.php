@extends('layouts.main')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="/edit-product/{{ $p->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Supplier</label>
                                <select name="supplier_id"  class="form-control @error('supplier_id') is-invalid @enderror" >
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $p->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>   
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Kategori</label>
                                <select id="categorySelect" name="category_id"  class="form-control @error('category_id') is-invalid @enderror" >
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-code="{{ $category->code }}" {{ $p->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>   
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Kode Barang</label>
                                <input value="{{ $p->code }}" readonly name="code" id="codeInput" type="text" class="form-control @error('code') is-invalid @enderror"  type="text" placeholder="Masukan Kode Barang" required>
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Nama Barang</label>
                                <input value="{{ $p->name }}"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Masukan Nama Barang" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Harga (Rp)</label>
                                <input value="{{ number_format($p->price, 0, ',', ',') }}"  id="price" class="form-control @error('price') is-invalid @enderror" name="price" type="text" placeholder="Masukan Harga Barang" required>
                                {{-- <input value="{{ $p->price }}"  id="price" class="form-control @error('price') is-invalid @enderror" name="price" type="text" placeholder="Masukan Harga Barang" required> --}}
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Stok</label>
                                <input value="{{ $p->stock }}"  type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" type="number" placeholder="Masukan Stok Barang" required>
                                @error('stock')
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
    
@endsection

@section('script')
    <script>
        
        $(document).ready(function() {
            $('#categorySelect').change(function() {
                let categoryCode = $('#categorySelect').find('option:selected').data('code');
                let code = generateCode(categoryCode)
                $('#codeInput').val(code)
            })

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('#price').on('input', function() {
                let value = $(this).val()
                value = value.replace(/^Rp\s*/, '')

                value = value.replace(/[^0-9]/g, '');

                if (value) {
                    value = formatNumber(value)
                    $(this).val(value)
                } else {
                    $(this).val('')
                }

                var plainValue = value.replace(/,/g, '');
                
            })

        })
        
    </script>
@endsection


