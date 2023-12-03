<?php

namespace App\Imports;

use App\Models\Kasambahay;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KasambahayImport implements ToCollection
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
                Kasambahay::create([
                    'kas_Name'          => $row[0],
                    'kas_Age'           => $row[1],
                    'kas_Sex'           => $row[2],
                    'kas_Dob'           => $row[3],
                    'kas_PlaceofBirth'  => $row[4],
                    'ka_address'        => $row[5],
                    'kas_HEAttainment'  => $row[6],
                    'kas_NatureofWork'  => $row[7],
                    'kas_Income'        => $row[8],
                    'kas_ContactNo_s'   => $row[9],
                    'kas_PHMember'      => $row[10],
                    'kas_PHNo'          => $row[11],
                    'kas_Category'      => $row[12],
                    'kas_NameEmployer'  => $row[13],
                    'kas_Dependent'     => $row[14],
                    'kas_Relationship'  => $row[15],
                    'kas_EmpAddress'    => $row[16],
                    'kas_StayType'      => $row[17],
                    'kas_YearService'   => $row[18],
                    'kas_familyComp'    => $row[19],
                    'kas_NeedKasambahay'=> $row[20],
                    'kas_signiture'     => $row[21],
                    'kas_status'        => 0,
                    'kas_statusType'    => 0,
                    'kas_Remarks'       => 'none'
                ]);
            }
        }
    }
}
