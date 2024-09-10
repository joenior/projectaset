@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="{{ route('pemindahan.index') }}" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Detail Pemindahan Barang</h1>
        
        <!-- Card untuk Detail Barang -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Detail Barang</h5>
                <table class="table">
                    <tr>
                        <th>Nomor Index</th>
                        <td>{{ $riwayat->barang->kode_barang ?? 'Barang ini telah dihapus.' }}</td>
                    </tr>
                    <tr>
                        <th>Gambar Barang</th>
                        <td>
                            @if($riwayat->barang && $riwayat->barang->gambar)
                                <img src="{{ asset('storage/' . $riwayat->barang->gambar) }}" alt="gambar barang" style="width: 150px; height: 150px;">
                            @else
                                Gambar tidak tersedia
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $riwayat->barang->nama ?? 'Barang ini telah dihapus.' }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $riwayat->barang->kategori->nama ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Subkategori</th>
                        <td>{{ $riwayat->barang->subkategori->nama ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Subdivisi</th>
                        <td>{{ $riwayat->barang->subdivisi->nama ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $riwayat->barang->satuan->nama ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{!! $riwayat->barang->deskripsi ?? 'N/A' !!}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Card untuk Detail Pemindahan Barang -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Pemindahan Barang</h5>
                <table class="table">
                    <tr>
                        <th>Gedung Sebelumnya</th>
                        <td>{{ $riwayat->previousGedung->nama_gedung ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Lantai Sebelumnya</th>
                        <td>{{ $riwayat->previousLantai->nama_lantai ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Ruangan Sebelumnya</th>
                        <td>{{ $riwayat->previousRuangan->nama_ruangan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Gedung Setelah</th>
                        <td>{{ $riwayat->gedung->nama_gedung }}</td>
                    </tr>
                    <tr>
                        <th>Lantai Setelah</th>
                        <td>{{ $riwayat->lantai->nama_lantai }}</td>
                    </tr>
                    <tr>
                        <th>Ruangan Setelah</th>
                        <td>{{ $riwayat->ruangan->nama_ruangan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pemindahan</th>
                        <td>{{ $riwayat->tanggal_pemindahan }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection