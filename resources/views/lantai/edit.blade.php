@extends('layouts.main')

@section('content')
    <a class="btn btn-secondary float-end" href="/lantai" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
    <h1 class="h3 mb-4">Edit Lantai</h1>
    
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="/lantai/{{ $lantai->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="nama_lantai" class="form-label">Nama Lantai</label>
                            <input type="text" class="form-control @error('nama_lantai') is-invalid @enderror" id="nama_lantai" name="nama_lantai" value="{{ old('nama_lantai', $lantai->nama_lantai) }}">
                            @error('nama_lantai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi', $lantai->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gedung_id" class="form-label">Gedung</label>
                            <select class="form-control @error('gedung_id') is-invalid @enderror" id="gedung_id" name="gedung_id">
                                @foreach ($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}" {{ $gedung->id == $lantai->gedung_id ? 'selected' : '' }}>{{ $gedung->nama_gedung }}</option>
                                @endforeach
                            </select>
                            @error('gedung_id')
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