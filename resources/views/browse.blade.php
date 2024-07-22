@extends('template.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="font-weight-bold text-primary">Browse</h6>
            <div class="d-flex justify-content-center">

                @if (Auth::user()->id_user_level == 13 || Auth::user()->id_user_level == 15 || Auth::user()->id_user_level == 17 || Auth::user()->id_user_level == 18)
                    <button type="button" class="btn btn-primary mr-0 mr-md-2" data-toggle="modal" data-target="#addDataBC40">
                        Add Data
                    </button>
                @endif

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
                            <th>Status</th>
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
                                    <div class="row justify-content-center">
                                        @if ($data->status == 'disetujui')
                                            <span class="badge badge-success text-sm">Done</span>
                                        @elseif($data->status == 'dikembalikan')
                                            <span class="badge badge-secondary text-sm">Returned</span>
                                        @elseif(is_null($data->status))
                                            <span class="badge badge-warning text-sm">Waiting for Approval</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if (Auth::user()->id_user_level == 11 || Auth::user()->id_user_level == 1)
                                        @if ($data->status == 'disetujui')
                                            <div class="row justify-content-center">
                                                Already Done
                                            </div>
                                        @elseif ($data->status == 'dikembalikan')
                                            <div class="row justify-content-center">
                                                Waiting for Revision
                                            </div>
                                        @else
                                            <div class="row justify-content-center">
                                                <a href="{{ route('approval-bc40.index', $data->id) }}" class="btn btn-sm btn-warning mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        @endif
                                    @elseif (Auth::user()->id_user_level == 13 || Auth::user()->id_user_level == 15 || Auth::user()->id_user_level == 17 || Auth::user()->id_user_level == 18)
                                        @if ($data->status == 'disetujui')
                                            <div class="row justify-content-center">
                                                Already Done
                                            </div>
                                        @elseif ($data->status == 'dikembalikan')
                                            <div class="row justify-content-center">
                                                <div class="row justify-content-center">
                                                    <button type="button" class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#updateDataBC40-{{ $data->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#deleteDataBC40-{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row justify-content-center">
                                                Already Sent
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            </tr>

                            <!-- Update Data Modal -->
                            <div class="modal fade bd-example-modal-lg" id="updateDataBC40-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="updateDataBC40Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateDataBC40Label">Update Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bc40.update', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nomorBC40" class="col-form-label">Nomor BC40</label>
                                                    <input type="number" class="form-control" id="nomorBC40" name="nomorBC40" value="{{ $data->nomor_bc40 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggalBC40" class="col-form-label">Tanggal BC40</label>
                                                    <input type="datetime-local" class="form-control" id="tanggalBC40" name="tanggalBC40" value="{{ \Carbon\Carbon::parse($data->tanggal_bc40)->format('Y-m-d\TH:i') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="npwpPengusaha" class="col-form-label">NPWP Pengusaha</label>
                                                    <input type="text" class="form-control" id="npwpPengusaha" name="npwpPengusaha" value="{{ $auth->npwp }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="namaPengusaha" class="col-form-label">Nama Pengusaha</label>
                                                    {{-- <select class="form-control" id="namaPengusaha" name="namaPengusaha">
                                                        @foreach ($data_users as $user)
                                                            <option value="{{ $user->nama_perusahaan }}" {{ strtoupper($user->nama_perusahaan) == strtoupper($data->nama_pengusaha) ? 'selected' : '' }}>
                                                                {{ $user->nama_perusahaan }}
                                                            </option>
                                                        @endforeach
                                                    </select> --}}
                                                    <input type="text" class="form-control" id="namaPengusaha" name="namaPengusaha" value="{{ $auth->nama_perusahaan }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="npwpPengirim" class="col-form-label">NPWP Pengirim</label>
                                                    <input type="text" class="form-control" id="npwpPengirim" name="npwpPengirim" value="{{ $data->npwp_pengirim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="namaPengirim" class="col-form-label">Nama Pengirim</label>
                                                    <input type="text" class="form-control" id="namaPengirim" name="namaPengirim" value="{{ $data->nama_pengirim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="npwpSupplier" class="col-form-label">NPWP Supplier</label>
                                                    <input type="text" class="form-control" id="npwpSupplier" name="npwpSupplier" value="{{ $data->npwp_supplier }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="namaSupplier" class="col-form-label">Nama Supplier</label>
                                                    <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" value="{{ $data->nama_supplier }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="uraianBarang" class="col-form-label">Uraian Barang</label>
                                                    <input type="text" class="form-control" id="uraianBarang" name="uraianBarang" value="{{ $data->uraian_barang }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="posTarif" class="col-form-label">Pos Tarif</label>
                                                    <input type="text" class="form-control" id="posTarif" name="posTarif" value="{{ $data->pos_tarif }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlahSatuan" class="col-form-label">Jumlah Satuan</label>
                                                    <input type="number" class="form-control" id="jumlahSatuan" name="jumlahSatuan" value="{{ $data->jumlah_satuan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kodeSatuan" class="col-form-label">Kode Satuan</label>
                                                    <input type="text" class="form-control" id="kodeSatuan" name="kodeSatuan" value="{{ $data->kode_satuan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="hargaPenyerahan" class="col-form-label">Harga Penyerahan</label>
                                                    <input type="number" class="form-control" id="hargaPenyerahan" name="hargaPenyerahan" value="{{ $data->harga_penyerahan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kadarFinal" class="col-form-label">Kadar Final</label>
                                                    <input type="number" step="0.01" class="form-control" id="kadarFinal" name="kadarFinal" value="{{ $data->kadar_final }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan" class="col-form-label">Keterangan</label>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $data->keterangan }}">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Konfirmasi Deleted -->
                            <div class="modal fade" id="deleteDataBC40-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteDataBC40" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="returnModalLabel">Confirm Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this BC-40?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('bc40.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Insert Data Modal -->
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
                            <input type="text" class="form-control" id="npwpPengusaha" name="npwpPengusaha" value="{{ $auth->npwp }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="namaPengusaha" class="col-form-label">Nama Pengusaha</label>
                            <input type="text" class="form-control" id="namaPengusaha" name="namaPengusaha" value="{{ $auth->nama_perusahaan }}" disabled>
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
