@extends('layouts.main')

@section('content')
    <a class="btn btn-secondary float-end" href="/gedung" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
    <h1 class="h3 mb-4">Tambah Gedung Baru</h1>
    
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="/gedung" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_gedung" class="form-label">Nama Gedung</label>
                            <input type="text" class="form-control @error('nama_gedung') is-invalid @enderror" id="nama_gedung" name="nama_gedung" value="{{ old('nama_gedung') }}">
                            @error('nama_gedung')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
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
@endsection