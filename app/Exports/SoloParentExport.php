<?php

namespace App\Exports;

use App\Models\SoloParent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SoloParentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.soloParent',[
            'soloParent' => SoloParent::where('solo_status', '=', 1)->get()
        ]);
    }
}
