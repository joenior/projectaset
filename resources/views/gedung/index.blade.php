@extends('layouts.main')

@section('content')
    <a class="btn btn-primary float-end" href="/gedung/create" role="button"><i class="bi bi-plus-circle"></i> Tambah Gedung</a>
    <h1 class="h3 mb-4">Data Gedung</h1>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Gedung</th>
                                    <th>Deskripsi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gedungs as $gedung)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $gedung->nama_gedung }}</td>
                                        <td>{{ $gedung->deskripsi }}</td>
                                        <td>
                                            <a href="/gedung/{{ $gedung->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="/gedung/{{ $gedung->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus gedung ini?')"><i class="bi bi-trash-fill"></i></button>
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