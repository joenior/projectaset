@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Permintaan Barang Yang Disetujui</h1>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>ID Pengadaan</th> -->
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Gedung</th>
                                    <th>Lantai</th>
                                    <th>Ruangan</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengadaans as $pengadaan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <!-- <td>{{ $pengadaan->id_pengadaans }}</td> -->
                                        <td>{{ $pengadaan->nama_pengadaan }}</td>
                                        <td>{{ $pengadaan->quantity }}</td>
                                        <td>{{ $pengadaan->unit }}</td>
                                        <td>{{ $pengadaan->gedung->nama_gedung }}</td>
                                        <td>{{ $pengadaan->lantai->nama_lantai }}</td>
                                        <td>{{ $pengadaan->ruangan->nama_ruangan }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $pengadaan->statuspengadaan->status }}</span>
                                        </td>
                                        <td>
                                            <a href="/pengadaan/{{ $pengadaan->id }}" class="btn btn-secondary d-inline mb-2"><i class="bi bi-eye-fill"></i></a>
                                            <form action="{{ route('barang.storeFromPengadaan', $pengadaan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <!-- <button type="submit" class="btn btn-primary mb-2"><i class="bi bi-plus-square"></i> Tambah Barang</button> -->
                                            </form>
                                        </td>
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
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection