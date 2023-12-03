<?php

namespace App\Imports;

use App\Models\seniorCitizine;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SeniorCitizen implements ToCollection
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
            if($keys != 0) {
                seniorCitizine::create([
                    'senior_nameSc'            => $row[0],
                    'senior_nhts_pr'           => $row[1],
                    'senior_sex'               => $row[2],
                    'senior_age'               => $row[3],
                    'senior_civilStatus'       => $row[4],
                    'senior_dob'               => $row[5],
                    'senior_placeOfBirth'      => $row[6],
                    'senior_address'           => $row[7],
                    'senior_occupation'        => $row[8],
                    'senior_landline'          => $row[9],
                    'senior_email'             => $row[10],
                    'senior_mobileNo'          => $row[11],
                    'senior_affiliation'       => $row[12],
                    'senior_livingArrangement' => $row[13],
                    'senior_pensoner'          => $row[14],
                    'senior_ifPensoner'        => $row[15],
                    'senior_ifNonPensoner'     => $row[16],
                    'senior_manyMeals'         => $row[17],
                    'senior_haveDisability'    => $row[18],
                    'immobile'                 => $row[19],
                    'bedridden'                => $row[20],
                    'assistive_device'         => $row[21],
                    'senior_existingIllness'   => $row[22],
                    'senior_scIdNo'            => $row[23],
                    'senior_signitureClient'   => 'none',
                    'senior_signiture'         => 'none',
                    'senior_status'            => 0,
                    'senior_statusType'        => 0,
                    'senior_remarks'           => 'none'
                ]);
            }
        }
    }
}
