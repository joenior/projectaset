@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-4">Laporan keuangan</h1>
        </div>
        <div class="col-md-6">
             <a class="btn btn-primary my-2 me-2 float-end" href="/keuangan/laporan-keuangan" target="_blank" Roles="button"><i class="bi bi-printer"></i>&nbsp; Cetak</a>                    
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Index</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hargaBarangs as $harga)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $harga->kode_barang }}</td>
                                        <td>{{ $harga->nama }}</td>
                                        <td>Rp. {{ number_format($harga->harga, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"><strong>Total Harga</strong></td>
                                    <td><strong>Rp. {{ number_format($totalHarga, 2, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

    <script>
        $(document).ready( function () {
            var table = $('#table_id').DataTable({
                "drawCallback": function( settings ) {
                    var api = this.api();
                    var total = api.column(3).data().reduce(function(acc, val) {
                        var harga = parseFloat(val.replace(/[^0-9.-]+/g,""));
                        return acc + harga;
                    }, 0);
                    $('#total-harga').html('Total Harga: Rp. '+ total);
                }
            });
        });
    </script>


@endsection