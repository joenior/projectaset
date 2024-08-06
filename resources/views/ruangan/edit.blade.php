@extends('layouts.main')

@section('content')
    <a class="btn btn-secondary float-end" href="/ruangan" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
    <h1 class="h3 mb-4">Edit Ruangan</h1>
    
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="/ruangan/{{ $ruangan->id }}" method="POST">
                    @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}">
                            @error('nama_ruangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lantai_id" class="form-label">Lantai</label>
                            <select class="form-control @error('lantai_id') is-invalid @enderror" id="lantai_id" name="lantai_id">
                                @foreach ($lantais as $lantai)
                                    <option value="{{ $lantai->id }}" {{ $lantai->id == $ruangan->lantai_id ? 'selected' : '' }}>{{ $lantai->nama_lantai }}</option>
                                @endforeach
                            </select>
                            @error('lantai_id')
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