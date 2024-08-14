@extends('layouts.main')

@section('content')
    @if (auth()->user()->roles === 'admin')
        <a class="btn btn-primary float-end" href="/barang/create" role="button"><i class="bi bi-collection"></i> Tambah Barang</a>
    @endif

    <h1 class="h3 mb-4">Data Barang</h1>
    
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
                                    <th>Kategori</th>
                                    <th>Subkategori</th>
                                    <th>Subdivisi</th>
                                    <!-- <th>Pengadaan</th> -->
                                    @if (auth()->user()->roles === 'admin')
                                        <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/'. $barang->gambar) }}" alt="gambar barang" style="width: 150px; height="150px"></td>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->gedung->nama_gedung }}</td>
                                        <td>{{ $barang->lantai->nama_lantai }}</td>
                                        <td>{{ $barang->ruangan->nama_ruangan }}</td>
                                        <td>{{ $barang->kategori->nama }}</td>
                                        <td>{{ $barang->subkategori->nama }}</td>
                                        <td>{{ $barang->subdivisi->nama }}</td>
                                        <!-- <td>{{ $barang->pengadaan?->id_pengadaans }}</td> -->
                                        @if (auth()->user()->roles === 'admin')
                                            <td>
                                                <a href="/barang/{{ $barang->id }}" class="btn btn-success mb-2"><i class="bi bi-eye-fill"></i></a>
                                                <a href="/barang/{{ $barang->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                                <form id="{{ $barang->id }}" action="/barang/{{ $barang->id }}" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="btn btn-danger mb-2 swal-confirm" data-form="{{ $barang->id }}"><i class="bi bi-trash-fill"></i></div>
                                                </form>
                                                <a href="{{ route('pemindahan.create', $barang->id) }}" class="btn btn-warning my-1"><i class="bi bi-arrow-repeat"></i> Pindahkan </a>
                                            </td>
                                        @endif
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