<?php

namespace App\Imports;

use App\Models\Family;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FamilyImport implements ToCollection
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
                Family::create([
                    'fam_nameClient'                    => $row[0],
                    'fam_sex'                           => $row[1],
                    'fam_namePayee'                     => $row[2],
                    'fam_dateOfBirth'                   => $row[3],
                    'fam_presentAddress'                => $row[4],
                    'fam_placeOfBirth'                  => $row[5],
                    'fam_relationshipTo'                => $row[6],
                    'fam_civilStatus'                   => $row[7],
                    'fam_religion'                      => $row[22],
                    'fam_nationality'                   => $row[8],
                    'fam_highEducAtt'                   => $row[9],
                    'fam_skillsOccu'                    => $row[10],
                    'fam_estimateMonthlyIncome'         => $row[11],
                    'fam_phlHealthNo'                   => $row[12],
                    'fam_modeAdmission'                 => $row[13],
                    'fam_refferingParty'                => $row[14],
                    'fam_contactAddress'                => $row[15],
                    'fam_nths'                          => $row[16],
                    'fam_beneficiaryName'               => $row[17],
                    'fam_beneficiarySex'                => $row[18],
                    'fam_beneficiaryDateOfBirth'        => $row[19],
                    'fam_beneficiarypresentAddress'     => $row[20],
                    'fam_beneficiaryCivilStatus'        => $row[21],
                    'fam_beneficiaryReligion'           => $row[22],
                    'fam_beneficiaryNationality'        => $row[23],
                    'fam_compMembers'                   => $row[24],
                    'fam_problemPresented'              => $row[25],
                    'fam_socialWorkerAss'               => $row[26],
                    'fam_clientCategory'                => $row[27],
                    'fam_natureAssistance'              => $row[28],
                    'fam_financialAssistance'           => $row[29],
                    'fam_financialAssistanceSpecify'    => $row[30],
                    'fam_financialAssistanceValuePesos' => $row[31],
                    'fam_amountFinancialAssistance'     => $row[32],
                    'fam_modeFinancialAssistance'       => $row[33],
                    'fam_sourceAssistance'              => $row[34],
                    'fam_sourceAssistanceRight'         => $row[35],
                    'fam_regularFund'                   => $row[36],
                    'fam_subTotal'                      => $row[37],
                    'fam_AddressOfPayee'                => $row[38],
                    'fam_clientSignature'               => $row[39],
                    'fam_workerSignature'               => $row[40],
                    'fam_unitHeadSignature'             => $row[41],
                    'fam_status'                        => 0,
                    'fam_statusType'                    => 0,
                    'fam_remarks'                       => 'none'
                ]);
            }
        }
    }
}
