@extends('template.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="font-weight-bold text-primary">Browse</h6>
            <div class="d-flex justify-content-center">

                <button type="button" class="btn btn-primary mr-0 mr-md-2" data-toggle="modal" data-target="#addDataBC40">
                    Add Data
                </button>

                <form action="{{ route('bc40-export') }}" method="POST">
                    @csrf
                    <button class="btn btn-md btn-success" type="submit">Export Excel</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%">
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
                                <td class="text-center">
                                    @if (Auth::user()->id_user_level == 11 || Auth::user()->id_user_level == 1)
                                        @if ($data->status == 'disetujui')
                                            <span class="badge badge-success text-sm">Done</span>
                                        @elseif($data->status == 'dikembalikan')
                                            <span class="badge badge-secondary text-sm">Returned</span>
                                        @else
                                            <div class="row justify-content-center">
                                                <a href="{{ route('approval-bc40.index', $data->id) }}" class="btn btn-sm btn-warning mr-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('approval-bc40.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="addDataBC40" tabindex="-1" role="dialog" aria-labelledby="addDataBC40Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDataBC40Label">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bc40-store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="nomorBC40" class="col-form-label">Nomor BC40</label>
                            <input type="number" class="form-control" id="nomorBC40" name="nomorBC40">
                        </div>
                        <div class="form-group">
                            <label for="tanggalBC40" class="col-form-label">Tanggal BC40</label>
                            <input type="datetime-local" class="form-control" id="tanggalBC40" name="tanggalBC40">
                        </div>
                        <div class="form-group">
                            <label for="npwpPengusaha" class="col-form-label">NPWP Pengusaha</label>
                            <input type="text" class="form-control" id="npwpPengusaha" name="npwpPengusaha">
                        </div>
                        <div class="form-group">
                            <label for="namaPengusaha" class="col-form-label">Nama Pengusaha</label>
                            <input type="text" class="form-control" id="namaPengusaha" name="namaPengusaha">
                        </div>
                        <div class="form-group">
                            <label for="npwpPengirim" class="col-form-label">NPWP Pengirim</label>
                            <input type="text" class="form-control" id="npwpPengirim" name="npwpPengirim">
                        </div>
                        <div class="form-group">
                            <label for="namaPengirim" class="col-form-label">Nama Pengirim</label>
                            <input type="text" class="form-control" id="namaPengirim" name="namaPengirim">
                        </div>
                        <div class="form-group">
                            <label for="npwpSupplier" class="col-form-label">NPWP Supplier</label>
                            <input type="text" class="form-control" id="npwpSupplier" name="npwpSupplier">
                        </div>
                        <div class="form-group">
                            <label for="namaSupplier" class="col-form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="namaSupplier" name="namaSupplier">
                        </div>
                        <div class="form-group">
                            <label for="uraianBarang" class="col-form-label">Uraian Barang</label>
                            <input type="text" class="form-control" id="uraianBarang" name="uraianBarang">
                        </div>
                        <div class="form-group">
                            <label for="posTarif" class="col-form-label">Pos Tarif</label>
                            <input type="text" class="form-control" id="posTarif" name="posTarif">
                        </div>
                        <div class="form-group">
                            <label for="jumlahSatuan" class="col-form-label">Jumlah Satuan</label>
                            <input type="number" class="form-control" id="jumlahSatuan" name="jumlahSatuan">
                        </div>
                        <div class="form-group">
                            <label for="kodeSatuan" class="col-form-label">Kode Satuan</label>
                            <input type="text" class="form-control" id="kodeSatuan" name="kodeSatuan">
                        </div>
                        <div class="form-group">
                            <label for="hargaPenyerahan" class="col-form-label">Harga Penyerahan</label>
                            <input type="number" class="form-control" id="hargaPenyerahan" name="hargaPenyerahan">
                        </div>
                        <div class="form-group">
                            <label for="kadarFinal" class="col-form-label">Kadar Final</label>
                            <input type="number" step="0.01" class="form-control" id="kadarFinal" name="kadarFinal">
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
