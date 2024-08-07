@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Cetak Label</h1>
    
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
                                    <th>Cetak Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/'. $barang->gambar) }}" alt="gambar barang" style="width: 150px"; height="150px"></td>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->gedung->nama_gedung }}</td>
                                        <td>{{ $barang->lantai->nama_lantai }}</td>
                                        <td>{{ $barang->ruangan->nama_ruangan }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="/barang/label/{{ $barang->id }}" target="_blank" Roles="button"><i class="bi bi-printer"></i>&nbsp; Cetak Label</a>
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