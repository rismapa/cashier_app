<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-6 {
            width: 50%;
            padding: 10px;
        }
        .col-12 {
            width: 100%;
            padding: 10px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .invoice-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-txt {
            font-size: 20px;
            font-weight: bold;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mb-1 {
            margin-bottom: .5rem;
        }
        .hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
        }
        .badge-success {
            color: #fff;
            background-color: #28a745;
        }
        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <div>
                                <div>
                                    <span class="logo-txt">BeautyShop</span>
                                    <h4 class="font-size-16">Kode Transaksi    : {{ $transaction->code }}</h4>
                                    <h4 class="font-size-16">Tanggal Transaksi : {{ $transaction->created_at->format('d-m-Y') }}</h4>
                                </div>
                            </div>
                        </div>
                        
                        <p>1874 County Line Road City, FL 33566</p>
                        <p>abc@123.com</p>
                        <p>012-345-6789</p>

                        <div class="p-4 border rounded">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->product->code }}</td>
                                                <td>{{ $order->product->name }}</td>
                                                <td>Rp {{ number_format($order->product->price, 0, ',', ',') }}</td>
                                                <td>{{ $order->qty }}</td>
                                                <td>Rp {{ number_format($order->total, 0, ',', ',') }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th scope="row" colspan="5" style="text-align: end">Total</th>
                                            <td class="border-0"><h4 class="m-0">Rp {{ number_format($total, 0, ',', ',') }}</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
