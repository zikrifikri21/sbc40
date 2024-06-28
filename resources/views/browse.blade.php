@extends('template.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Browse</h6>
            <div class="d-flex">
                <form action="{{ route('bc40-export') }}" method="POST">
                    @csrf
                    <button class="btn btn-md btn-success" type="submit">Export Excel</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-responsive" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>Data BC40</th>
                            <th>Pengirim dan Supplier</th>
                            <th>Data Barang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bc40 as $data)
                            <tr>
                                <td>
                                    <small>
                                        Nomor BC40:
                                        <b>
                                            {{ $data->nomor_bc40 }} </b>
                                        <br>
                                        Tanggal BC40:
                                        <b>
                                            {{ \Carbon\Carbon::parse($data->tanggal_bc40)->format('d-m-Y') }}
                                        </b>
                                        <br>
                                        Nama Pengusaha:
                                        <b>{{ $data->nama_pengusaha }} </b>
                                        <br>
                                        NPWP Pengusaha:
                                        <b>{{ $data->npwp_pengusaha }}</b>
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        <b>
                                            <u>Pengirim</u>
                                        </b>
                                        <br>
                                        NPWP:
                                        <b>
                                            {{ $data->npwp_pengirim }}
                                        </b><br>
                                        Nama:
                                        <b>
                                            {{ $data->nama_pengirim }}
                                        </b>
                                        <br>
                                        <b>
                                            <u>Supplier</u>
                                        </b>
                                        <br>
                                        NPWP:
                                        <b> {{ $data->npwp_supplier }} </b>
                                        <br>
                                        Nama:
                                        <b> {{ $data->nama_supplier }} </b>
                                    </small>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <small>
                                                <b> Uraian Barang </b>
                                                <br>
                                                {{ $data->uraian_barang }}
                                                <br>
                                                <b>Pos tarif</b><br>
                                                {{ $data->pos_tarif }}
                                                <br>
                                                <b>Jumlah Satuan</b><br>
                                                {{ $data->jumlah_satuan }}
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small>
                                                <b>Kode Satuan</b><br>
                                                {{ $data->kode_satuan }}
                                                <br>
                                                <b>Harga Penyerahan</b><br>
                                                {{ $data->harga_penyerahan }}
                                                <br>
                                                <b>Kadar Final</b><br>
                                                {{ $data->kadar_final }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
