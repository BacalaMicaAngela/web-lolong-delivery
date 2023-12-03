<?php

namespace App\Exports;

use App\Models\Kasambahay;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KasambahayExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.kasambahay',[
            'kasambahay' => Kasambahay::where('kas_status', '=', 1)->get()
        ]);
    }
}
