<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function backupDatabase($param) {
        try {
            $output='';

                    // $showTable=json_decode(json_encode(DB::select('SHOW CREATE TABLE '.$_POST[$i].'')), true);
                    // foreach ($showTable as $createTable) {
                    //     $output .= "\n\n".$createTable['Create Table']."\n\n";
                    // }

                    $selectQuery=json_decode(json_encode(DB::select('SELECT * FROM '.$param.'')), true);
                    $countRow   =json_decode(json_encode(DB::select('SELECT COUNT(*) AS `count` FROM '.$param.'')), true);

                    for ($count=0; $count < $countRow[0]['count']; $count++) {
                        $tableColumn = array_keys($selectQuery[$count]);
                        $tableValue  = array_values($selectQuery[$count]);

                        $output .= "\nINSERT INTO " . $param . "(";
                        $output .= "" . implode(", ", $tableColumn ) . ") VALUES (";
                        $output .= "'" . implode("', '", $tableValue) . "');\n";
                    }


                $filename = $param.'_backup_on_'.date('Y-m-d h:i A').'.sql';


            echo json_encode(array(
                "message"  => 'Backup Database Table successfully.',
                "filename" => $filename,
                "dataFile" => $output,
                "status"   => "success"
            ));


        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: ".$e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function restoreDatabase(Request $request) {

        $file_extension = array_reverse(explode(".", basename($_FILES["file"]['name'])))[0];

        if($file_extension != 'sql') {
            echo json_encode(array(
                "message" => "Warning: Invalid Database File!",
                "status"  => "warning"
            ));
            die();
        }

        if (is_uploaded_file($_FILES['file']['tmp_name'])
        ) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name'])
            ) {
                try {
                    $sql_dump = File::get($_FILES['file']['name']);
                    DB::connection()->getPdo()->exec($sql_dump);

                    echo json_encode(array(
                        "message" => "Restore Database Successfully!",
                        "status"  => "success"
                    ));

                } catch (Exception $e) {
                    echo json_encode(array(
                        "message" => "Warning: ".$e->getMessage(),
                        "status"  => "warning"
                    ));
                }
            }
        }
    }
}
