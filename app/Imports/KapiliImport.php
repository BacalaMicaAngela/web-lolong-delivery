<?php

namespace App\Imports;

use App\Models\kapili;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KapiliImport implements ToCollection
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
                kapili::create([
                        'numNo'                    => '0000000',
                        'kapili_name'              => $row[0],
                        'kapili_dob'               => $row[1],
                        'kapili_civilStatus'       => $row[2],
                        'kapili_gender'            => $row[3],
                        'kapili_bloodType'         => $row[4],
                        'kapili_weight'            => $row[5],
                        'kapili_height'            => $row[6],
                        'kapili_religion'          => $row[7],
                        'kapili_contactNo'         => $row[8],
                        'kapili_emailAd'           => $row[9],
                        'kapili_address'           => $row[10],
                        'kapili_spouseName'        => $row[11],
                        'kapili_spouseOccupation'  => $row[12],
                        'kapili_childrenDetails'   => $row[13],
                        'kapili_fathersName'       => $row[14],
                        'kapili_fathersOccupation' => $row[15],
                        'kapili_mothersName'       => $row[16],
                        'kapili_mothersOccupation' => $row[17],
                        'kapili_personToContact'   => $row[18],
                        'kapili_personContactNo'   => $row[19],
                        'kapili_checkAllApplies'   => $row[20],
                        'kapili_elem'              => $row[21],
                        'kapili_elemGradYear'      => $row[22],
                        'kapili_hs'                => $row[23],
                        'kapili_hsGradYear'        => $row[24],
                        'kapili_college'           => $row[25],
                        'kapili_collegeGradYear'   => $row[26],
                        'kapili_degreeRecieve'     => $row[27],
                        'specialSkills'            => $row[28],
                        'kapili_personelExp'       => $row[29],
                        'kapili_membership'        => $row[30],
                        'kapili_signature'         => $row[31],
                        'kapili_img'               => 'default.png',
                        'kapili_status'            => 0,
                        'kapili_statusType'        => 0,
                        'kapili_remarks'           => 'none'
                ]);
            }
        }
    }
}
