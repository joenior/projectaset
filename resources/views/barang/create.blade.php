@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/barang/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Tambah Barang Baru</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/barang" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Data Master Barang -->
                            <h2 class="h4 mb-3">Data Master Barang</h2>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">Rp</span>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" step="0.01" value="{{ old('harga') }}">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subkategori" class="form-label">Subkategori</label>
                                <select class="form-select" id="subkategori" name="subkategori_id" disabled>
                                    <option value="">Pilih Subkategori</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subdivisi" class="form-label">Subdivisi</label>
                                <select class="form-select" id="subdivisi" name="subdivisi_id" disabled>
                                    <option value="">Pilih Subdivisi</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan_id" disabled>
                                    <option value="">Pilih Satuan</option>
                                </select>
                            </div>

                            <!-- Data Master Lokasi -->
                            <h2 class="h4 mb-3">Data Master Lokasi</h2>

                            <div class="mb-3">
                                <label for="gedung" class="form-label">Gedung</label>
                                <select class="form-select" id="gedung" name="gedung_id">
                                    <option value="">Pilih Gedung</option>
                                    @foreach ($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lantai" class="form-label">Lantai</label>
                                <select class="form-select" id="lantai" name="lantai_id" disabled>
                                    <option value="">Pilih Lantai</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" id="ruangan" name="ruangan_id" disabled>
                                    <option value="">Pilih Ruangan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input class="form-control" type="text" value="{{ date('d/m/Y') }}" aria-label="Disabled input example" name="tanggal" disabled readonly>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" onchange="previewImage()">
                                <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview" style="max-height: 250px; overflow:hidden; border: 1px solid black;">
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="text" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kategoriSelect = document.getElementById('kategori');
    const subkategoriSelect = document.getElementById('subkategori');
    const subdivisiSelect = document.getElementById('subdivisi');
    const satuanSelect = document.getElementById('satuan');
    const gedungSelect = document.getElementById('gedung');
    const lantaiSelect = document.getElementById('lantai');
    const ruanganSelect = document.getElementById('ruangan');

    kategoriSelect.addEventListener('change', function () {
        const kategoriId = this.value;
        subkategoriSelect.disabled = true;
        subdivisiSelect.disabled = true;
        satuanSelect.disabled = true;
        if (kategoriId) {
            fetch(`/api/subkategori/${kategoriId}`)
                .then(response => response.json())
                .then(data => {
                    subkategoriSelect.innerHTML = '<option value="">Pilih Subkategori</option>';
                    data.forEach(subkategori => {
                        subkategoriSelect.innerHTML += `<option value="${subkategori.id}">${subkategori.nama}</option>`;
                    });
                    subkategoriSelect.disabled = false;
                });
        }
    });

    subkategoriSelect.addEventListener('change', function () {
        const subkategoriId = this.value;
        subdivisiSelect.disabled = true;
        satuanSelect.disabled = true;
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

    subdivisiSelect.addEventListener('change', function () {
        const subdivisiId = this.value;
        if (subdivisiId) {
            fetch(`/api/satuan/${subdivisiId}`)
                .then(response => response.json())
                .then(data => {
                    satuanSelect.innerHTML = '<option value="">Pilih Satuan</option>';
                    data.forEach(satuan => {
                        satuanSelect.innerHTML += `<option value="${satuan.id}">${satuan.nama}</option>`;
                    });
                    satuanSelect.disabled = false;
                });
        }
    });

    gedungSelect.addEventListener('change', function () {
        const gedungId = this.value;
        lantaiSelect.disabled = true;
        ruanganSelect.disabled = true;
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

    lantaiSelect.addEventListener('change', function () {
        const lantaiId = this.value;
        if (lantaiId) {
            fetch(`/api/ruangan/${lantaiId}`)
                .then(response => response.json())
                .then(data => {
                    ruanganSelect.innerHTML = '<option value="">Pilih Ruangan</option>';
                    data.forEach(ruangan => {
                        ruanganSelect.innerHTML += `<option value="${ruangan.id}">${ruangan.nama_ruangan}</option>`;
                    });
                    ruanganSelect.disabled = false;
                });
        }
    });
});

function previewImage(){
    preview.src=URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection