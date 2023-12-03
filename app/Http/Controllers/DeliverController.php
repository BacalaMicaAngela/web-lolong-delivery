<?php

namespace App\Http\Controllers;

use App\Models\Deliver;
use Illuminate\Http\Request;

class DeliverController extends Controller
{
    public function manageDeliver(Request $request)
    {
        try {
            if (empty($request->id)) {
                $obj = new Deliver();
                $obj->driver_id  = $request->driver_id;
                $obj->truck_id   = $request->truck_id;
                $obj->helper     = $request->helper;
                $obj->trucker_code = $request->truckercode;
                $obj->deliver_status = 0;
                $msg = 'save';
            } else {
                $obj = Deliver::find($request->id);

                if ($obj->trucker_code == (int)$request->truckercode) {
                    echo json_encode(array(
                        "message" => "Trucker ID already exist.",
                        "status"  => "warning"
                    ));
                    dd();
                }

                $obj->driver_id  = $request->driver_id;
                $obj->truck_id   = $request->truck_id;
                $obj->helper     = $request->helper;
                $obj->trucker_code = (int)$request->truckercode;
                $msg = 'updated';
            }

            if ($obj->save()) {
                echo json_encode(array(
                    "message" => "Data $msg.",
                    "status"  => "success"
                ));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function showDeliver($id)
    {
        try {
            echo json_encode(array(
                "message" => Deliver::where('deliver_id', '=', $id)->get(),
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function destroyDeliver(Request $request)
    {
        if (count($_POST) == 0) {
            echo json_encode(array(
                "message" => 'Warning: Empty Check Field!',
                "status"  => "warning"
            ));
            return response()->json([
                "message" => 'Warning: Empty Check Field!',
                "status"  => "warning"
            ]);
        }

        try {
            for ($i = 0; $i < count($_POST); $i++) {

                if ($_POST[$i] != 'on') {
                    $obj = Deliver::find($_POST[$i]);
                    $res = $obj->delete();
                }
            }

            if ($res) {
                echo json_encode(array(
                    "message" => 'Remove data success.',
                    "status"  => "success"
                ));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }
}
