@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Riwayat Penghapusan Aset</h1>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar Barang</th>
                                    <th>Nomor Index</th>
                                    <th>Nama Barang</th>
                                    <th>Gedung</th>
                                    <th>Lantai</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Dihapus</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedBarangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/'. $barang->gambar) }}" alt="gambar barang" style="width: 150px; height: 150px;"></td>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->gedung->nama_gedung }}</td>
                                        <td>{{ $barang->lantai->nama_lantai }}</td>
                                        <td>{{ $barang->ruangan->nama_ruangan }}</td>
                                        <td>{{ $barang->deleted_at }}</td>
                                        <td>
                                            <form action="/penghapusan-aset/restore/{{ $barang->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary my-1"><i class="bi bi-arrow-repeat"></i> Kembalikan </button>
                                            </form>

                                            <form id="{{ $barang->id }}" action="/penghapusan-aset/{{ $barang->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <div class="btn btn-danger mb-2 swal-confirm" data-form="{{ $barang->id }}"><i class="bi bi-trash-fill"></i> Permanen</div>
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
        $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    </script>

@endsection