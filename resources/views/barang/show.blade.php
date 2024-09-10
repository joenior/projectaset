@extends('layouts.main')

@section('content')

<style>
    td{
        font-size: 16px;
        padding-bottom: 4px;
    }
</style>

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/barang/" Roles="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Detail Barang</h1>
       
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/'. $barang->gambar) }}" alt="gambar barang" class="card-img-top">
                </div>
                <div class="card-mb-4">
                    <img src="{{ asset('storage/qrcode-barang/'. $barang->kode_barang . '.png') }}" alt="qr-code" style="width: 250px; height: 250px; display: block; margin: 0 auto;">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">{{ $barang->nama }}</div>
                        <hr>
                        <table style="width:100%">
                            <tr>
                                <td><b>Nomor Index</b></td>
                                <td>:</td>
                                <td>{{ $barang->kode_barang }}</td>
                            </tr>
                            <tr>
                                <td><b>Harga Pembelian</b></td>
                                <td>:</td>
                                <td>Rp. {{ $barang->harga }}</td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Penambahan</b></td>
                                <td>:</td>
                                <td>{{ $barang->tanggal }}</td>
                            </tr>
                            <tr>
                                <td><b>Kategori</b></td>
                                <td>:</td>
                                <td>{{ $barang->kategori->nama}}</td>
                            </tr>
                            <tr>
                                <td><b>Subkategori</b></td>
                                <td>:</td>
                                <td>{{ $barang->subkategori->nama }}</td>
                            </tr>
                            <tr>
                                <td><b>Subdivisi</b></td>
                                <td>:</td>
                                <td>{{ $barang->subdivisi->nama }}</td>
                            </tr>
                            <tr>
                                <td><b>Satuan</b></td>
                                <td>:</td>
                                <td>{{ $barang->satuan->nama}}</td>
                            </tr>
                            <tr>
                                <td><b>Deskripsi</b></td>
                                <td>:</td>
                                <td><br>{!! $barang->deskripsi !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="/barang/label/{{ $barang->id }}" target="_blank" Roles="button"><i class="bi bi-printer"></i>&nbsp; Cetak Label</a>
                    </div>
                </div>
                    <div class="card">
        <div class="card-body">
        <div class="row">
            <div class="col-md-6">

                        <div class="card-title">Penyusutan</div>
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $barang->nama }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $barang->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>{{ $barang->harga }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $barang->tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Penyusutan</th>
                        <td data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Rumus: Penyusutan = (Harga / Umur Ekonomis) * Tahun Berjalan">{{ $barang->penyusutan }}</td>
                    </tr>
                </table>
                <a href="{{ route('barang.calculateDepreciation', $barang->id) }}" class="btn btn-primary">Hitung Penyusutan</a>
</div>
        </div>
        </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('[data-bs-toggle="popover"]').popover();   
    });
</script>

    @endsection