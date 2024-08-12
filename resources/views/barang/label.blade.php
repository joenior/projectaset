<!DOCTYPE html>
<html>
<head>
    <title>Label Barang</title>
    <style>
        /* style untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
        }

        th {
            /* width: 100px; */
        }

        .header {
            text-align: center;
            font-weight: bold;
        }

        .logo {
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td rowspan="2" class="logo">
                    <img src="data:image/png;base64,{{ $logoInstansi }}" alt="Logo Instansi" style="width: 150px; height: 150px;">
                </td>
                <td colspan="4" class="header">ASET ULBI</td>
                <td rowspan="2" style="text-align:center;">
                    <img src="data:image/png;base64,{{$qrCode}}" style="width: 150px; height: 150px;">
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $barang->gedung->nama_gedung }}</td>
                <td>{{ $barang->lantai->nama_lantai }}</td>
                <td>{{ $barang->ruangan->nama_ruangan }}</td>
                <td>{{ $barang->kode_barang }}</td>
            </tr>
            <tr>
                <td colspan="4">Tanggal Penambahan: {{ $barang->tanggal }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>