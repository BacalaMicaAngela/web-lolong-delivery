<?php

namespace App\Imports;

use App\Models\Disability;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DisabilityImport implements ToCollection
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
                Disability::create([
                    'dis_Lname'                => $row[0],
                    'dis_Fname'                => $row[1],
                    'dis_Mname'                => $row[2],
                    'dis_Suffix'               => $row[3],
                    'dis_BirthDate'            => $row[4],
                    'dis_Age'                  => $row[5],
                    'dis_Religion'             => $row[6],
                    'dis_Ethnicity'            => $row[7],
                    'dis_Sex'                  => $row[8],
                    'dis_CivilStatus'          => $row[9],
                    'dis_BloodType'            => $row[10],
                    'dis_TypeofDisability'     => $row[11],
                    'dis_CauseofDisability'    => $row[12],
                    'dis_Address'              => $row[13],
                    'dis_ContactNo'            => $row[14],
                    'dis_EducAttain'           => $row[15],
                    'dis_StatusofEmployment'   => $row[16],
                    'dis_Occupation'           => $row[17],
                    'dis_CategoryofEmployment' => $row[18],
                    'dis_TypesofEmployment'    => $row[19],
                    'dis_OrgAffiliated'        => $row[20],
                    'dis_ContactPerson'        => $row[21],
                    'dis_OffAddress'           => $row[22],
                    'dis_Telnos'               => $row[23],
                    'dis_Sss'                  => $row[24],
                    'dis_Gsis'                 => $row[25],
                    'dis_PagIbig'              => $row[26],
                    'dis_PhilHealth'           => $row[27],
                    'dis_FathersName'          => $row[28],
                    'dis_MothersName'          => $row[29],
                    'dis_GuardiansName'        => $row[30],
                    'dis_signature'            => $row[31],
                    'dis_status'               => 0,
                    'dis_statusType'           => 0,
                    'dis_remarks'              => 'none'
                ]);
            }
        }
    }
}
