<?php

namespace App\Exports;

use App\Models\Disability;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DisabilityExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.disbility',[
            'disability' => Disability::where('dis_status', '=', 1)->get()
        ]);
    }
}
