@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Pemindahan Lokasi Barang</h1>

    <form action="{{ route('pemindahan.store', $barang->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="gedung_id" class="form-label">Gedung</label>
            <select class="form-select" id="gedung_id" name="gedung_id" required>
                @foreach($gedungs as $gedung)
                    <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="lantai_id" class="form-label">Lantai</label>
            <select class="form-select" id="lantai_id" name="lantai_id" required>
                @foreach($lantais as $lantai)
                    <option value="{{ $lantai->id }}">{{ $lantai->nama_lantai }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="ruangan_id" class="form-label">Ruangan</label>
            <select class="form-select" id="ruangan_id" name="ruangan_id" required>
                @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection