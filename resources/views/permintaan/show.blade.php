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
        <a class="btn btn-secondary float-end" href="/permintaan/" Roles="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Detail Pengajuan</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex">
                        <h1>{{ $pengadaan->nama_pengadaan }}</h1>
                    </div>
                    <div class="card-body">
                      <table style="width:100%">
                        <hr>
                        <tr>
                            <td><b>Tanggal Pengajuan</b></td>
                            <td>:</td>
                            <td>{{ $pengadaan->tanggal_pengajuan }}</td>
                        </tr>
                        <tr>
                            <td><b>Quantity</b></td>
                            <td>:</td>
                            <td>{{ $pengadaan->quantity }}</td>
                        </tr>
                        <tr>
                            <td><b>Gedung</b></td>
                            <td>:</td>
                            <td>{{ $pengadaan->gedung->nama_gedung }}</td>
                        </tr>
                        <tr>
                            <td><b>Lantai</b></td>
                            <td>:</td>
                            <td>{{ $pengadaan->lantai->nama_lantai }}</td>
                        </tr>
                        <tr>
                            <td><b>Ruangan</b></td>
                            <td>:</td>
                            <td>{{ $pengadaan->ruangan->nama_ruangan }}</td>
                        </tr>
                        <tr>
                            <td><b>Deskripsi</b></td>
                            <td>:</td>
                            <td><br>{!! $pengadaan->deskripsi !!}</td>
                        </tr>
                        <tr>
                            <td><b>Catatan</b></td>
                            <td>:</td>
                            <td>{!! $status ? $status->catatan : 'Belum ada catatan yang ditambahkan oleh yayasan' !!}</td>
                      </tr>

                      <tr>
                        <td>
                            Dikirim Oleh : {{ $pengadaan->user->name }}
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection