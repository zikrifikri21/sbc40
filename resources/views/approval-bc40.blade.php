@extends('template.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="font-weight-bold text-primary">Detail BC-40</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nomorBC40" class="col-form-label">Nomor BC40</label>
                        <input type="number" class="form-control" id="nomorBC40" value="{{ $bc40->nomor_bc40 }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggalBC40" class="col-form-label">Tanggal BC40</label>
                        <input type="text" class="form-control" id="tanggalBC40" value="{{ $bc40->tanggal_bc40 }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="npwpPengusaha" class="col-form-label">NPWP Pengusaha</label>
                        <input type="text" class="form-control" id="npwpPengusaha" value="{{ $bc40->npwp_pengusaha }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="namaPengusaha" class="col-form-label">Nama Pengusaha</label>
                        <input type="text" class="form-control" id="namaPengusaha" value="{{ $bc40->nama_pengusaha }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="npwpPengirim" class="col-form-label">NPWP Pengirim</label>
                        <input type="text" class="form-control" id="npwpPengirim" value="{{ $bc40->npwp_pengirim }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="namaPengirim" class="col-form-label">Nama Pengirim</label>
                        <input type="text" class="form-control" id="namaPengirim" value="{{ $bc40->nama_pengirim }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="npwpSupplier" class="col-form-label">NPWP Supplier</label>
                        <input type="text" class="form-control" id="npwpSupplier" value="{{ $bc40->npwp_supplier }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="namaSupplier" class="col-form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="namaSupplier" value="{{ $bc40->nama_supplier }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="uraianBarang" class="col-form-label">Uraian Barang</label>
                        <input type="text" class="form-control" id="uraianBarang" value="{{ $bc40->uraian_barang }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="posTarif" class="col-form-label">Pos Tarif</label>
                        <input type="text" class="form-control" id="posTarif" value="{{ $bc40->pos_tarif }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlahSatuan" class="col-form-label">Jumlah Satuan</label>
                        <input type="number" class="form-control" id="jumlahSatuan" value="{{ $bc40->jumlah_satuan }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kodeSatuan" class="col-form-label">Kode Satuan</label>
                        <input type="text" class="form-control" id="kodeSatuan" value="{{ $bc40->kode_satuan }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hargaPenyerahan" class="col-form-label">Harga Penyerahan</label>
                        <input type="number" class="form-control" id="hargaPenyerahan" value="{{ $bc40->harga_penyerahan }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kadarFinal" class="col-form-label">Kadar Final</label>
                        <input type="number" step="0.01" class="form-control" id="kadarFinal" value="{{ $bc40->kadar_final }}" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="5" disabled>{{ $bc40->keterangan }}</textarea>
                    </div>
                </div>
            </form>

            <div class="text-right mx mt-3 pb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal">Approve</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#returnModal">Returned</button>
                <a href="{{ route('bc40-browse') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Approve -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve this BC-40?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="approvalForm" action="{{ route('approval-bc40.status', $bc40->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" form="approvalForm" name="status" class="btn btn-success" value="disetujui">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Returned -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnModalLabel">Confirm Returned</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to return this BC-40?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" form="approvalForm" name="status" class="btn btn-success" value="dikembalikan">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
