@extends('layouts.main')

@section('content')
    <a class="btn btn-primary float-end" href="/ruangan/create" role="button"><i class="bi bi-plus-circle"></i> Tambah Ruangan</a>
    <h1 class="h3 mb-4">Data Ruangan</h1>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ruangan</th>
                                    <th>Deskripsi</th>
                                    <th>Lantai</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruangans as $ruangan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ruangan->nama_ruangan }}</td>
                                        <td>{{ $ruangan->deskripsi }}</td>
                                        <td>{{ $ruangan->lantai->nama_lantai }}</td>
                                        <td>
                                            <a href="/ruangan/{{ $ruangan->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="/ruangan/{{ $ruangan->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')"><i class="bi bi-trash-fill"></i></button>
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