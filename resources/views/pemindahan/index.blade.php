@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Riwayat Pemindahan Lokasi Barang</h1>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Gedung</th>
                                    <th>Lantai</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Pemindahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPemindahans as $riwayat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $riwayat->barang->nama }}</td>
                                        <td>{{ $riwayat->gedung->nama_gedung }}</td>
                                        <td>{{ $riwayat->lantai->nama_lantai }}</td>
                                        <td>{{ $riwayat->ruangan->nama_ruangan }}</td>
                                        <td>{{ $riwayat->tanggal_pemindahan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection