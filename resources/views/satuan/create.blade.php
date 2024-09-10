@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/satuan/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Tambah Unit Baru</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/satuan" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Satuan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subkategori_id" class="form-label">Subkategori</label>
                                <select class="form-select" id="subkategori_id" name="subkategori_id">
                                    <option value="">Pilih Subkategori</option>
                                    @foreach ($subkategoris as $subkategori)
                                        <option value="{{ $subkategori->id }}">{{ $subkategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subdivisi_id" class="form-label">Subdivisi</label>
                                <select class="form-select" id="subdivisi_id" name="subdivisi_id" disabled>
                                    <option value="">Pilih Subdivisi</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const subkategoriSelect = document.getElementById('subkategori_id');
        const subdivisiSelect = document.getElementById('subdivisi_id');

        subkategoriSelect.addEventListener('change', function () {
            const subkategoriId = this.value;
            subdivisiSelect.disabled = true;
            if (subkategoriId) {
                fetch(`/api/subdivisi/${subkategoriId}`)
                    .then(response => response.json())
                    .then(data => {
                        subdivisiSelect.innerHTML = '<option value="">Pilih Subdivisi</option>';
                        data.forEach(subdivisi => {
                            subdivisiSelect.innerHTML += `<option value="${subdivisi.id}">${subdivisi.nama}</option>`;
                        });
                        subdivisiSelect.disabled = false;
                    });
            }
        });
    });
</script>

@endsection