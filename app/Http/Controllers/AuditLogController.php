<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Models\ActionLog;

class AuditLogController extends Controller
{
    public function removeLogs(Request $request) {

        if(count($_POST) == 0) {
            echo json_encode(array(
                "message" => 'Warning: Empty Check Field!',
                "status"  => "warning"
            ));
            die();
        }

        try {
            for ($i=0; $i < count($_POST); $i++) {

                if ($_POST[$i]!='on') {
                    $obj = AuditLog::find($_POST[$i]);
                    $res = $obj->delete();
                }
            }

            if($res) {
                echo json_encode(array(
                    "message" => 'Delete Logs Permanently Successfully.',
                    "status"  => "success"
                ));
            }

        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: ".$e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function actionLog($id) {
        $action = ActionLog::where('user_id', '=', $id)->orderBy('action_id', 'DESC')->get();

        echo json_encode(array(
            "message" => $action,
            "status"  => "success"
        ));
    }
}
