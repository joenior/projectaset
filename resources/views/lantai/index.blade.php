@extends('layouts.main')

@section('content')
    <a class="btn btn-primary float-end" href="/lantai/create" role="button"><i class="bi bi-plus-circle"></i> Tambah Lantai</a>
    <h1 class="h3 mb-4">Data Lantai</h1>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lantai</th>
                                    <th>Deskripsi</th>
                                    <th>Gedung</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lantais as $lantai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lantai->nama_lantai }}</td>
                                        <td>{{ $lantai->deskripsi }}</td>
                                        <td>{{ $lantai->gedung->nama_gedung }}</td>
                                        <td>
                                            <a href="/lantai/{{ $lantai->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="/lantai/{{ $lantai->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus lantai ini?')"><i class="bi bi-trash-fill"></i></button>
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