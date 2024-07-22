<?php

namespace App\Http\Controllers;

use App\Exports\BC40Export;
use App\Http\Requests\Bc40Request;
use App\Imports\BC40Import;
use App\Models\Bc40;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Bc40Controller extends Controller
{
    public  function dashboard()
    {
        $bc40 = Bc40::orderBy('nomor_bc40', 'desc')->get();

        $count = count($bc40);

        return view('dashboard', compact('bc40', 'count'));
    }

    public  function browse()
    {
        $bc40 = Bc40::orderBy('nomor_bc40', 'desc')->get();

        return view('browse', compact('bc40'));
    }

    public function index()
    {
        return view('bc40');
    }

    public function import(Bc40Request $bc40)
    {
        try {
            $importer = new BC40Import;

            Excel::import($importer, $bc40->file('file'));

            $duplicateErrors = $importer->getDuplicateErrors();

            if (!empty($duplicateErrors)) {
                session()->flash('error', count($duplicateErrors) - 1 . ' baris sudah ada.');
                $response = array_slice($duplicateErrors, 0, -1);

                return redirect()->back()->withErrors($response);
            }

            return back()->with('success', 'Excel Data Imported successfully.');
        } catch (\Exception $e) {
            $link = '<a href="' . route('download_template') . '" class="btn btn-outline-primary mt-3">Download Template</a>';
            session()->flash(
                'error',
                'Ops, terjadi kesalahan. <b><small>Sepertinya format data tidak sesuai.</small></b> ' . $link
            );
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomorBC40' => 'required',
            'tanggalBC40' => 'required',
            'npwpPengusaha' => 'required|',
            'namaPengusaha' => 'required',
            'npwpPengirim' => 'required|',
            'namaPengirim' => 'required',
            'npwpSupplier' => 'required|',
            'namaSupplier' => 'required',
            'uraianBarang' => 'required',
        ]);

        $bc40 = new Bc40;
        $bc40->nomor_bc40 = $request->nomorBC40;
        $bc40->tanggal_bc40 = $request->tanggalBC40;
        $bc40->npwp_pengusaha = $request->npwpPengusaha;
        $bc40->nama_pengusaha = $request->namaPengusaha;
        $bc40->npwp_pengirim = $request->npwpPengirim;
        $bc40->nama_pengirim = $request->namaPengirim;
        $bc40->npwp_supplier = $request->npwpSupplier;
        $bc40->nama_supplier = $request->namaSupplier;
        $bc40->uraian_barang = $request->uraianBarang;
        $bc40->pos_tarif = $request->posTarif;
        $bc40->jumlah_satuan = $request->jumlahSatuan;
        $bc40->kode_satuan = $request->kodeSatuan;
        $bc40->harga_penyerahan = $request->hargaPenyerahan;
        $bc40->kadar_final = $request->kadarFinal;
        $bc40->keterangan = $request->keterangan;
        $bc40->save();

        // dd($bc40);

        return redirect()->route('bc40-browse')->with('success', 'Data successfully saved.');
    }


    public function approval_index(string $id)
    {
        $auth = auth()->user();
        $bc40 = Bc40::where('id', $id)->first();

        return view('approval-bc40', compact('bc40'));
    }

    public function approval_status(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string|in:disetujui,dikembalikan'
        ]);

        $bc40 = Bc40::findOrFail($id);
        $bc40->update(['status' => $request->status]);

        return redirect()->route('bc40-browse')->with('success', 'Data has been updated.');
    }

    public function approval_destroy(string $id)
    {
        $bc40 = Bc40::findOrFail($id);
        $bc40->delete();

        return redirect()->route('bc40-browse')->with('success', 'Data successfully deleted.');
    }

    public function export()
    {
        return Excel::download(new BC40Export, 'bc40_export.xlsx');
    }

    public function download_template()
    {
        return response()->download(public_path('template_format.xlsx'));
    }
}
