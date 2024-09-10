@extends('layouts.main')

@section('content')
@if (auth()->user()->roles === 'admin')
    <a class="btn btn-primary float-end" href="/satuan/create" role="button"><i class="bi bi-hdd-stack"></i>Tambah Unit</a>
@endif
    <h1 class="h3 mb-4">Unit</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Satuan</th>
                                    <th>Nama Satuan</th>
                                    <th>Deskripsi</th>
                                    <th>Subkategori</th>
                                    <th>Subdivisi</th>
                                    @if (auth()->user()->roles === 'admin')
                                    <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($satuans as $satuan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $satuan->id_satuan }}</td>
                                        <td>{{ $satuan->nama }}</td>
                                        <td>{{ $satuan->deskripsi }}</td>
                                        <td>{{ $satuan->subdivisi ? $satuan->subdivisi->subkategori->nama : 'N/A' }}</td>
                                        <td>{{ $satuan->subdivisi ? $satuan->subdivisi->nama : 'N/A' }}</td>
                                        @if (auth()->user()->roles === 'admin')
                                        <td>
                                            <a href="/satuan/{{ $satuan->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="{{ route('satuan.destroy', $satuan->id) }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus satuan ini?')"><i class="bi bi-trash-fill"></i></button>
                                            </form>
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
        $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    </script>

@endsection