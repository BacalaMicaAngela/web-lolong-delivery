<?php

namespace App\Exports;

use App\Models\seniorCitizine;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SeniorCitizenExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.seniorCitizen',[
            'seniorCitizen' => seniorCitizine::where('solo_status', '=', 1)->get()
        ]);
    }
}
