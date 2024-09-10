@extends('layouts.main')

@section('content')
    <a class="btn btn-secondary float-end" href="/ruangan" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
    <h1 class="h3 mb-4">Tambah Ruangan Baru</h1>
    
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="/ruangan" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan') }}">
                            @error('nama_ruangan')
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
                        <div class="mb-3">
                            <label for="gedung_id" class="form-label">Gedung</label>
                            <select class="form-control @error('gedung_id') is-invalid @enderror" id="gedung_id" name="gedung_id">
                                <option value="">Pilih Gedung</option>
                                @foreach ($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                                @endforeach
                            </select>
                            @error('gedung_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lantai_id" class="form-label">Lantai</label>
                            <select class="form-control @error('lantai_id') is-invalid @enderror" id="lantai_id" name="lantai_id" disabled>
                                <option value="">Pilih Lantai</option>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const gedungSelect = document.getElementById('gedung_id');
            const lantaiSelect = document.getElementById('lantai_id');

            gedungSelect.addEventListener('change', function () {
                const gedungId = this.value;
                lantaiSelect.disabled = true;
                if (gedungId) {
                    fetch(`/api/lantai/${gedungId}`)
                        .then(response => response.json())
                        .then(data => {
                            lantaiSelect.innerHTML = '<option value="">Pilih Lantai</option>';
                            data.forEach(lantai => {
                                lantaiSelect.innerHTML += `<option value="${lantai.id}">${lantai.nama_lantai}</option>`;
                            });
                            lantaiSelect.disabled = false;
                        });
                }
            });
        });
    </script>
@endsection