<?php

namespace App\Imports;

use App\Models\SpecailProtective;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SpecailProtectiveImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $keys => $row)
        {
            if ($keys != 0) {
                SpecailProtective::create([
                    'protect_name'                   => $row[0],
                    'protect_age'                    => $row[1],
                    'protect_dob'                    => $row[2],
                    'protect_sex'                    => $row[3],
                    'protect_civilStatus'            => $row[4],
                    'protect_educlAttainment'        => $row[5],
                    'protect_address'                => $row[6],
                    'protect_occupation'             => $row[7],
                    'protect_contactNumber'          => $row[8],
                    'protect_family'                 => $row[9],
                    'protect_presentProblem'         => $row[10],
                    'protect_background'             => $row[11],
                    'protect_situation'              => $row[12],
                    'protect_feelings'               => $row[13],
                    'protect_behavior'               => $row[14],
                    'protect_mechanics'              => $row[15],
                    'protect_duration'               => $row[16],
                    'protect_immmediateConcern'      => $row[17],
                    'protect_interviewer'            => $row[18],
                    'protect_client'                 => $row[19],
                    'protect_status'                 => 0,
                    'protect_statusType'             => 0,
                    'protect_remarks'                => 'none'
                ]);
            }
        }
    }
}
