<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bc40Request;
use App\Imports\BC40Import;
use App\Models\Bc40;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Bc40Controller extends Controller
{

    public function index()
    {
        return view('bc40');
    }

    public function import(Bc40Request $bc40)
    {
        try {
            Excel::import(new Bc40Import($bc40), request()->file('file'));

            return response()->json([
                'success' => true,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
