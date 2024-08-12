@extends('layouts.main')

@section('content')
@if (auth()->user()->roles === 'admin')
    <a class="btn btn-primary float-end" href="/subkategori/create" role="button"><i class="bi bi-diagram-3"></i> Tambah Subkategori</a>
@endif
    <h1 class="h3 mb-4">Data Subkategori</h1>
   
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Subkategori</th>
                                    <th>Nama Subkategori</th>
                                    <th>Deskripsi</th>
                                    @if (auth()->user()->roles === 'admin')
                                    <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subkategories as $subkategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subkategori->id_subkategori }}</td>
                                        <td>{{ $subkategori->nama }}</td>
                                        <td>{{ $subkategori->deskripsi }}</td>
                                        @if (auth()->user()->roles === 'admin')
                                        <td>
                                            <a href="/subkategori/{{ $subkategori->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="/subkategori/{{ $subkategori->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus subkategori ini?')"><i class="bi bi-trash-fill"></i></button>
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
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection