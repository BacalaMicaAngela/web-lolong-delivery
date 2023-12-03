<?php

namespace App\Exports;

use App\Models\kapili;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KalipiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.kalipi',[
            'kalipi' => kapili::where('kapili_status', '=', 1)->get()
        ]);
    }
}
