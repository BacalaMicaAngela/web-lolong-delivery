<?php

namespace App\Imports;

use App\Models\disaster;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DisasterImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
         foreach ($rows as $keys => $row) {
            if ($keys != 0) {
                disaster::create([
                    'disas_religion'            => $row[0],
                    'disas_serialNo'            => $row[1],
                    'disas_ProviewDistrict'     => $row[2],
                    'disas_cityMunBrgy'         => $row[3],
                    'disas_evacuationCenter'    => $row[4],
                    'disas_headOfFamily'        => $row[5],
                    'disas_gender'              => $row[6],
                    'disas_Age'                 => $row[7],
                    'disas_dob'                 => $row[8],
                    'disas_occupation'          => $row[9],
                    'disas_MonthlyNetIncome'    => $row[10],
                    'disas_4PsBeneficairy'      => $row[11],
                    'disas_ipTypeOfEthnicity'   => $row[12],
                    'family_members'            => $row[13],
                    'disas_checkField'          => $row[14],
                    'disas_code'                => $row[15],
                    'disas_housingCondition'    => $row[16],
                    'healthCondition'           => $row[17],
                    'disas_familyHeadSignature' => $row[18],
                    'disas_brgyCaptainSignature'=> $row[19],
                    'disas_lswdoSignature'      => $row[20],
                    'disas_img'                 => 'default.png',
                    'disas_statusType'          => 0,
                    'disas_status'              => 0,
                    'disas_remarks'             => 'none'
                ]);
            }
        }
    }
}
