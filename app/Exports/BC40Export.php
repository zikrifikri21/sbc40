<?php

namespace App\Exports;

use App\Models\Bc40;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class BC40Export implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.bc40', [
            'bc40' => Bc40::orderBy('nomor_bc40', 'desc')->get()
        ]);
    }
}
