<?php

namespace App\Exports;

use App\Models\Family;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FamilyExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.family',[
            'family' => Family::where('fam_status', '=', 1)->get()
        ]);
    }
}
