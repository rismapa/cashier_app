<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1, .footer p {
            margin: 0;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .col {
            flex: 1;
            padding: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .summary div {
            flex: 1;
            padding: 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Penjualan</h1>
            <p>Periode: {{ $start_date }} - {{ $end_date }}</p>
        </div>

        <div class="row">
            <div class="col">
                <p><strong>Nama Toko:</strong> Beauty Shop</p>
                <p><strong>Alamat:</strong> 1234 Example Street, Cityville, ST 56789</p>
                <p><strong>Email:</strong> info@beautyshop.com</p>
                <p><strong>Telepon:</strong> (123) 456-7890</p>
            </div>
            <div class="col text-right">
                <p><strong>Tanggal Cetak:</strong> {{ $now }}</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->transaction->created_at->format('d-m-Y') }}</td>
                        <td>{{ $order->transaction->code }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>Rp {{ number_format($order->product->price, 0, ',', ',') }}</td>
                        <td>Rp {{ number_format($order->transaction->subtotal, 0, ',', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div>
                <p><strong>Jumlah Transaksi:</strong> {{ $countTransaction }}</p>
                <p><strong>Total Produk Terjual:</strong> {{ $countProduct }}</p>
            </div>
            <div class="text-right">
                <p><strong>Total Penjualan:</strong> Rp {{ number_format($sum, 0, ',', ',') }}</p>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda kepada Beauty Shop.</p>
        </div>
    </div>
</body>
</html>
