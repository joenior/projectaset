@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/barang/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Tambah Barang Baru dari Pengadaan</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.storeFromPengadaan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pengadaan_id" value="{{ $pengadaan->id }}">

                            <!-- Data Master Barang -->
                            <h2 class="h4 mb-3">Data Master Barang</h2>

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $pengadaan->nama_pengadaan) }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $pengadaan->quantity) }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="unit" class="form-label">Satuan</label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $pengadaan->unit) }}" required>
                                @error('unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gedung_id" class="form-label">Gedung</label>
                                <select class="form-select" id="gedung_id" name="gedung_id" required>
                                    @foreach($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}" {{ old('gedung_id', $pengadaan->gedung_id) == $gedung->id ? 'selected' : '' }}>{{ $gedung->nama_gedung }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lantai_id" class="form-label">Lantai</label>
                                <select class="form-select" id="lantai_id" name="lantai_id" required>
                                    @foreach($lantais as $lantai)
                                        <option value="{{ $lantai->id }}" {{ old('lantai_id', $pengadaan->lantai_id) == $lantai->id ? 'selected' : '' }}>{{ $lantai->nama_lantai }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ruangan_id" class="form-label">Ruangan</label>
                                <select class="form-select" id="ruangan_id" name="ruangan_id" required>
                                    @foreach($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}" {{ old('ruangan_id', $pengadaan->ruangan_id) == $ruangan->id ? 'selected' : '' }}>{{ $ruangan->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="10">{{ old('deskripsi', $pengadaan->deskripsi) }}</textarea>
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