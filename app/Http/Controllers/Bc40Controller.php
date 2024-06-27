<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bc40Request;
use App\Imports\BC40Import;
use App\Models\Bc40;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Bc40Controller extends Controller
{
    public  function dashboard()
    {
        return view('dashboard');
    }

    public  function browse()
    {
        return view('browse');
    }

    public function index()
    {
        return view('bc40');
    }

    public function import(Bc40Request $bc40)
    {
        try {
            Excel::import(new BC40Import, $bc40->file('file'));

            return back()->with('success', 'Excel Data Imported successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
