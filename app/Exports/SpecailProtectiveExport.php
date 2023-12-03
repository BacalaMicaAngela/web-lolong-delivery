<?php

namespace App\Exports;

use App\Models\SpecailProtective;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SpecailProtectiveExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.specailProtective',[
            'specailProtective' => SpecailProtective::where('protect_status', '=', 1)->get()
        ]);
    }
}
