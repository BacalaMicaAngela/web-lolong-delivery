<?php

namespace App\Exports;

use App\Models\disaster;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DisastertExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.disaster',[
            'disaster' => disaster::where('disas_status', '=', 1)->get()
        ]);
    }
}
