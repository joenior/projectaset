<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        .container {
            margin: 0 auto;
            width: 100%;
            max-width: 800px;
        }
        .logo {
            float: left;
            width: 100px;
            height: 100px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .header h1, .header p {
            margin: 0;
        }
        .table {
            margin-bottom: 50px;
            border-collapse: collapse;
            width: 100%;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        .table th {
            background-color: #ccc;
        }
        .table tfoot td {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="data:image/png;base64,{{ $logoInstansi }}" alt="Logo Instansi" style="width:100px" height="100px">
        </div>
        <div class="header">
            <h1>Badan usaha Milik Desa Mitra Sehati</h1>
            <p>Karangmulyo, RT.01, RW.02. Kec. Purwodadi, Kab. Purworejo</p>
        </div>

        <h3 style="text-align: center">
            <h3 class="h3 mb-4">Laporan keuangan</h3>
        </h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Index</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hargaBarangs as $harga)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $harga->kode_barang }}</td>
                        <td>{{ $harga->nama }}</td>
                        <td>Rp. {{ number_format($harga->harga, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total Harga</strong></td>
                    <td><strong>Rp. {{ number_format($totalHarga, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>