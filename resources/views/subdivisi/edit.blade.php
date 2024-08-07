@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/subdivisi/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Edit Subdivisi</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/subdivisi/{{ $subdivisi->id }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Subdivisi</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $subdivisi->nama }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ $subdivisi->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection