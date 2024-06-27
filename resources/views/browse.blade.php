@extends('template.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Browse</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-responsive" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>Nomor BC40</th>
                            <th>Tanggal BC40</th>
                            <th>NPWP Pengusaha</th>
                            <th>Nama Pengusaha</th>
                            <th>NPWP Pengirim</th>
                            <th>Nama Pengirim</th>
                            <th>NPWP Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Uraian Barang</th>
                            <th>Pos Tarif</th>
                            <th>Jumlah Satuan</th>
                            <th>Kode Satuan</th>
                            <th>Harga Penyerahan</th>
                            <th>Kadar Final</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bc40 as $data)
                            <tr>
                                <td>{{ $data->nomor_bc40 }}</td>
                                <td>{{ $data->tanggal_bc40 }}</td>
                                <td>{{ $data->npwp_pengusaha }}</td>
                                <td>{{ $data->nama_pengusaha }}</td>
                                <td>{{ $data->npwp_pengirim }}</td>
                                <td>{{ $data->nama_pengirim }}</td>
                                <td>{{ $data->npwp_supplier }}</td>
                                <td>{{ $data->nama_supplier }}</td>
                                <td>{{ $data->uraian_barang }}</td>
                                <td>{{ $data->pos_tarif }}</td>
                                <td>{{ $data->jumlah_satuan }}</td>
                                <td>{{ $data->kode_satuan }}</td>
                                <td>{{ $data->harga_penyerahan }}</td>
                                <td>{{ $data->kadar_final }}</td>
                                <td>{{ $data->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
