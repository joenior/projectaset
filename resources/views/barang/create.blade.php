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
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="text" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
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
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" aria-label="Default select example" id="kategori" name="kategori_id">
                                    @foreach ($kategoris as $kategori)
                                        @if (old('kategori_id') == $kategori->id)
                                            <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                                        @else
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subkategori" class="form-label">Subkategori</label>
                                <select class="form-select" aria-label="Default select example" id="subkategori" name="subkategori_id">
                                    @foreach ($subkategoris as $subkategori)
                                        @if (old('subkategori_id') == $subkategori->id)
                                            <option value="{{ $subkategori->id }}" selected>{{ $subkategori->nama }}</option>
                                        @else
                                            <option value="{{ $subkategori->id }}">{{ $subkategori->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subdivisi" class="form-label">Subdivisi</label>
                                <select class="form-select" aria-label="Default select example" id="subdivisi" name="subdivisi_id">
                                    @foreach ($subdivisis as $subdivisi)
                                        @if (old('subdivisi_id') == $subdivisi->id)
                                            <option value="{{ $subdivisi->id }}" selected>{{ $subdivisi->nama }}</option>
                                        @else
                                            <option value="{{ $subdivisi->id }}">{{ $subdivisi->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" aria-label="Default select example" id="satuan" name="satuan_id">
                                    @foreach ($satuans as $satuan)
                                        @if (old('satuan_id') == $satuan->id)
                                            <option value="{{ $satuan->id }}" selected>{{ $satuan->nama }}</option>
                                        @else
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Data Master Lokasi -->
                            <h2 class="h4 mb-3">Data Master Lokasi</h2>

                            <div class="mb-3">
                                <label for="gedung" class="form-label">Gedung</label>
                                <select class="form-select" aria-label="Default select example" id="gedung" name="gedung_id">
                                    @foreach ($gedungs as $gedung)
                                        @if (old('gedung_id') == $gedung->id)
                                            <option value="{{ $gedung->id }}" selected>{{ $gedung->nama_gedung }}</option>
                                        @else
                                            <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lantai" class="form-label">Lantai</label>
                                <select class="form-select" aria-label="Default select example" id="lantai" name="lantai_id">
                                    @foreach ($lantais as $lantai)
                                        @if (old('lantai_id') == $lantai->id)
                                            <option value="{{ $lantai->id }}" selected>{{ $lantai->nama_lantai }}</option>
                                        @else
                                            <option value="{{ $lantai->id }}">{{ $lantai->nama_lantai }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" aria-label="Default select example" id="ruangan" name="ruangan_id">
                                    @foreach ($ruangans as $ruangan)
                                        @if (old('ruangan_id') == $ruangan->id)
                                            <option value="{{ $ruangan->id }}" selected>{{ $ruangan->nama_ruangan }}</option>
                                        @else
                                            <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input class="form-control" type="text" value="{{ date('d/m/Y') }}" aria-label="Disabled input example" name="tanggal" disabled readonly>
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
    function previewImage(){
        preview.src=URL.createObjectURL(event.target.files[0]);
    }
</script>

@endsection