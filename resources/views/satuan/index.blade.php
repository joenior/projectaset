@extends('layouts.main')

@section('content')
    <a class="btn btn-primary float-end" href="/satuan/create" Roles="button"><i class="bi bi-hdd-stack"></i>  Tambah satuan</a>
    <h1 class="h3 mb-4">Jenis satuan</h1>
   

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
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($satuans as $satuan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $satuan->id_satuan }}</td>
                                        <td>{{ $satuan->nama }}</td>
                                        <td>{{ $satuan->deskripsi }}</td>
                                        <td>
                                            <a href="/satuan/{{ $satuan->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="/satuan/{{ $satuan->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus satuan ini?')"><i class="bi bi-trash-fill"></i></button>
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