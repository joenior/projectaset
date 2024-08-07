<!DOCTYPE html>
<html>
<head>
    <title>Label Barang</title>
</head>
<body>
    <table>
        <tr> 
            <td rowspan="4"><img src="data:image/png;base64,{{ $logoInstansi }}" alt="Logo Instansi" style="width: 150px; height: 150px; text-align:center;"></td>
            <th>Nomor Index</th>
            <td>{{ $barang->kode_barang }}</td>
            <td rowspan="4"><img src="data:image/png;base64,{{$qrCode}}" style="width: 150px; height: 150px; text-align:center;"></td>
        </tr>
        <tr>
            <th>Gedung</th>
            <td>{{ $barang->gedung->nama_gedung }}</td>
        </tr>
        <tr>
            <th>Lantai</th>
            <td>{{ $barang->lantai->nama_lantai }}</td>
        </tr>
        <tr>
            <th>Ruangan</th>
            <td>{{ $barang->ruangan->nama_ruangan }}</td>
        </tr>
        <tr>
            <th>Tanggal Penambahan</th>
            <td>{{ $barang->tanggal }}</td>
        </tr>
    </table>
    
</body>
</html>