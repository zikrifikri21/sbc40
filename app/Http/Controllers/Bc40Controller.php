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

    public function export()
    {
        return Excel::download(new BC40Export, 'bc40_export.xlsx');
    }

    public function download_template()
    {
        return response()->download(public_path('template_format.xlsx'));
    }
}
