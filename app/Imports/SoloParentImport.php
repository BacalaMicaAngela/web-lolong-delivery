<?php

namespace App\Imports;

use App\Models\SoloParent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SoloParentImport implements ToCollection
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
                 SoloParent::create([
                    'solo_Name'                     => $row[0],
                    'solo_Age'                      => $row[1],
                    'solo_Sex'                      => $row[2],
                    'solo_Dob'                      => $row[3],
                    'solo_PlaceofBirth'             => $row[4],
                    'solo_address'                  => $row[5],
                    'solo_HEAttainment'             => $row[6],
                    'solo_NatureofWork'             => $row[7],
                    'solo_Income'                   => $row[8],
                    'solo_ContactNo_s'              => $row[9],
                    'solo_PHMember'                 => $row[10],
                    'solo_PHNo'                     => $row[11],
                    'solo_Category'                 => $row[12],
                    'solo_Dependent'                => $row[13],
                    'relationship'                  => $row[14],
                    'solo_familyComp'               => $row[15],
                    'solo_ClassificationSoloParent' => $row[16],
                    'solo_NeedSoloParent'           => $row[17],
                    'solo_FamilySource'             => $row[18],
                    'solo_signature'                => $row[19],
                    'solo_status'                   => 0,
                    'solo_statusType'               => 0,
                    'solo_remarks'                  => 'none'
                ]);
            }
        }
    }
}
