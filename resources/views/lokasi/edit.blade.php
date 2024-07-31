
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/lokasi" Roles="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Edit Lokasi</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/lokasi/{{ $lokasi->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
                                <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}">
                                @error('nama_lokasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="text" cols="30" rows="10">{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
