@extends('layouts.main')

@section('content')
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

@if (auth()->user()->roles === 'admin')
    <a class="btn btn-primary float-end" href="/subdivisi/create" role="button"><i class="bi bi-diagram-3"></i> Tambah Subdivisi</a>
@endif
    <h1 class="h3 mb-4">Data Subdivisi</h1>
   
    <div class="row mb-3">
        <div class="col-md-4">
            <select id="filter-kategori" class="form-select">
                <option value="">Pilih Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select id="filter-subkategori" class="form-select">
                <option value="">Pilih Subkategori</option>
                @foreach ($subkategoris as $subkategori)
                    <option value="{{ $subkategori->nama }}">{{ $subkategori->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Subdivisi</th>
                                    <th>Kategori</th>
                                    <th>Subkategori</th>
                                    <th>Nama Subdivisi</th>
                                    <th>Deskripsi</th>
                                    @if (auth()->user()->roles === 'admin')
                                    <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subdivisis as $subdivisi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subdivisi->id_subdivisi }}</td>
                                        <td>{{ $subdivisi->subkategori->kategori->nama }}</td>
                                        <td>{{ $subdivisi->subkategori->nama }}</td>
                                        <td>{{ $subdivisi->nama }}</td>
                                        <td>{{ $subdivisi->deskripsi }}</td>
                                        @if (auth()->user()->roles === 'admin')
                                        <td>
                                            <a href="/subdivisi/{{ $subdivisi->id }}/edit" class="btn btn-warning mb-2"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="/subdivisi/{{ $subdivisi->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus subdivisi ini?')"><i class="bi bi-trash-fill"></i></button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#table_id').DataTable();

            $('#filter-kategori').on('change', function () {
                var selectedKategori = $(this).val();
                console.log('Selected Kategori:', selectedKategori); // Log debug
                table.column(2).search(selectedKategori).draw();
                console.log('DataTable search result for Kategori:', table.column(2).data()); // Log debug
            });

            $('#filter-subkategori').on('change', function () {
                var selectedSubkategori = $(this).val();
                console.log('Selected Subkategori:', selectedSubkategori); // Log debug
                table.column(3).search(selectedSubkategori).draw();
                console.log('DataTable search result for Subkategori:', table.column(3).data()); // Log debug
            });
        });
    </script>
@endsection