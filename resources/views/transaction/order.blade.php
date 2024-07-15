@extends('layouts.main')

@section('content')

    {{-- {{ dd($transactionCode) }} --}}
   
    <div class="col-lg-12 card">
        <div class="card-body">
            <form action="" method="POST" id="addOrder">
                @csrf
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <label for="example-text-input" class="form-label">Kode Transaksi</label>
                        <input id="transaction_code" readonly value="{{ $transactionCode }}" class="form-control" name="transaction_code" type="text" required>
                        <input type="hidden" id="transaction_id" value="{{ $transactionId }}">
                    </div>
                    {{-- {{ dd() }} --}}
                    <div class="col-lg-4 mb-3">
                        <label for="choices-single-groups" class="form-label">Kode Barang</label>
                        <select id="searchProduct" class="form-control" data-trigger name="product_id" id="choices-single-groups">
                            <option value="">--Pilih Kode Barang--</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Nama Barang</label>
                            <input readonly id="productName" type="text" class="form-control @error('productName') is-invalid @enderror" name="productName" type="text" placeholder="Masukan Nama Barang" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Harga Satuan (Rp)</label>
                            <input readonly id="productPrice"  type="text" class="form-control @error('name') is-invalid @enderror" name="productPrice" type="text" placeholder="Masukan Nama Barang" required>
                            @error('productPrice')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Qty</label>
                            <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" placeholder="Masukan Nama Barang" required>
                            @error('qty')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12 card mt-2">
        <div class="row mt-3 mx-2">
            <div class="col-lg-2 col-md-6 col-6">
                <button type="button" onclick="showModal()" class="modal-btn btn btn-primary waves-effect waves-light w-100">Selesai</button>
            </div>
            <div class="col-lg-2 col-md-6 col-6">
                <a href="/transaction" class="btn btn-danger waves-effect waves-light w-100">Batal</a>
            </div>
        </div>
        <di class="card-body">
            <table id="orders-table" class="table table-bordered dt-responsive  nowrap w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </di>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Total Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mb-2">
                            <div class="col-lg-4 d-flex align-items-center">
                                <label for="example-text-input" class="form-label">Kode Transaksi</label>
                            </div>
                            <div class="col-lg-8">
                                <input id="transaction_code" readonly value="{{ $transactionCode }}" class="form-control" name="transaction_code" type="text" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-4 d-flex align-items-center">
                                <label for="example-text-input" class="form-label">Total (Rp)</label>
                            </div>
                            <div class="col-lg-8">
                                <input id="orderTotal" readonly value="" class="form-control" name="total" type="text" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-4 d-flex align-items-center">
                                <label for="example-text-input" class="form-label">Uang Diberikan(Rp)</label>
                            </div>
                            <div class="col-lg-8">
                                <input id="givenAmount" class="form-control" name="given_amount" type="text" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-4 d-flex align-items-center">
                                <label for="example-text-input" class="form-label">Uang Kembalian (Rp)</label>
                            </div>
                            <div class="col-lg-8">
                                <input id="change" readonly value="" class="form-control" name="change" type="text" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="updateTransaction btn btn-primary">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>        
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('#searchProduct').on('change', function() {
                let productId = $(this).val();
                // console.log(productId);
                if (productId) {
                    $.ajax({
                        url: "/get-product/" + productId,
                        method: 'GET',
                        success: function (data) {
                            if(data.name && data.price) {
                                $('#productName').val(data.name);
                                $('#productPrice').val(formatNumber(data.price));
                            } else {
                                $('#productName').val();
                                $('#productPrice').val();
                            }
                        }
                    });
                } else {
                    $('#productName').val();
                    $('#productPrice').val();
                }
            })

            $('#addOrder').on('submit', function(e) {
                e.preventDefault();
                let productId = $('#searchProduct').val()
                let transaction_id = $('#transaction_id').val()
                let qty = $('#qty').val()

                $.ajax({
                    url: '/add-order',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        'product_id' : productId,
                        'transaction_id' : transaction_id,
                        'qty' : qty,
                    },
                    method: 'POST',
                    success: function(data) {
                        console.log(data);
                        $('#searchProduct').val(null);
                        $('#qty').val('');
                        getDataTransaction();
                    }
                });
            })

            function getDataTransaction() {
                let transactionId = $('#transaction_id').val();
                let i = 1;
                let tableContent = '';
                $.ajax({
                    url: '/get-orders/' + transactionId,
                    method: 'GET',
                    success: function(response) {
                        if (Array.isArray(response.productItem)) {
                            console.log(response.productItem);

                            response.productItem.forEach(function(productItem) {
                                let formattedPrice = formatNumber(productItem.productPrice)
                                let formattedTotal = formatNumber(productItem.total)

                                tableContent += `
                                    <tr>
                                        <td> ${i} </td>
                                        <td> ${productItem.productCode} </td>
                                        <td> ${productItem.productName} </td>
                                        <td> Rp ${formattedPrice} </td>
                                        <td> ${productItem.qty} </td>
                                        <td> Rp ${formattedTotal} </td>
                                    </tr>
                                `;
                                i++;
                                // $('#orders-table tbody').append(`
                                //     <tr>
                                //         <td> ${i} </td>
                                //         <td> ${productItem.productCode} </td>
                                //         <td> ${productItem.productName} </td>
                                //         <td> Rp ${formattedPrice} </td>
                                //         <td> ${productItem.qty} </td>
                                //         <td> Rp ${formattedTotal} </td>
                                //     </tr>
                                // `);
                                
                            })
                            $('#orders-table tbody').html(tableContent);
                        } else {
                            console.error('Error fetching data', error);
                        }
                    }
                })
            }

            function showModal(transactionId) {
                $.ajax({
                    url: '/get-modal/' + transactionId,
                    method: 'GET',
                    success: function(response) {
                        console.log(response.total);
                        // console.log(response.orderTotal);
                        $('#staticBackdrop .modal-body').html(response.html);
                        $('#staticBackdrop').modal('show');
                        $('#orderTotal').val(formatNumber(response.total));
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    }
                })
            }

            $('.modal-btn').on('click', function() {
                let transactionId = $('#transaction_id').val()
                if ($('#orders-table tbody tr').length === 0) {
                    alert('Belum ada produk ditambahkan!');
                } else {
                    showModal(transactionId);
                }
            })

            $('#givenAmount').keyup(function() {
                let formatted = $('#givenAmount').val().replace(/,/g, '')
                $(this).val(formatNumber(formatted)) 
                
                let total = parseFloat($('#orderTotal').val().replace(/,/g, ''))
                let givenAmount = parseFloat($('#givenAmount').val().replace(/,/g, ''))

                let change = givenAmount - total

                $('#change').val(formatNumber(change))
            })

            $('.updateTransaction').on('click', function() {
                if(!confirm('Apakah Anda yakin?')) {
                    return;
                }

                let transaction_id = $('#transaction_id').val()
                let subtotal = $('#orderTotal').val().replace(/,/g, '')
                let given_amount = $('#givenAmount').val().replace(/,/g, '')
                let change = $('#change').val().replace(/,/g, '')

                $.ajax({
                    url: '/update-transaction/' + transaction_id,
                    method: 'PUT',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        'subtotal' : subtotal,
                        'given_amount' : given_amount,
                        'change' : change,
                        'status' : 'success',
                    },
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = response.redirect;   
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    }
                })
            })

        });
    </script>
@endsection
