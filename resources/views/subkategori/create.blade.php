@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/subkategori/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Tambah Subkategori Baru</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/subkategori" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Subkategori</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori_id" name="kategori_id">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
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