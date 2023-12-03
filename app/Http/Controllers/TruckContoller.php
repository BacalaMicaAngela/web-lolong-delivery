<?php

namespace App\Http\Controllers;

use App\Models\Trucks;
use Illuminate\Http\Request;

class TruckContoller extends Controller
{
    public function manageTruck(Request $request)
    {
        try {
            if (empty($request->id)) {
                $obj = new Trucks();
                $obj->truck_name     = $request->brandname;
                $obj->truck_plateno  = $request->plateno;
                $obj->model          = $request->model;
                $obj->chasisno       = $request->chassisno;
                $msg = 'save';
            } else {
                $obj = Trucks::find($request->id);
                $obj->truck_name     = $request->brandname;
                $obj->truck_plateno  = $request->plateno;
                $obj->model          = $request->model;
                $obj->chasisno       = $request->chassisno;
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

    public function showTruck($id)
    {
        try {
            echo json_encode(array(
                "message" => Trucks::where('truck_id', '=', $id)->get(),
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function destroyTruck(Request $request)
    {
        if (count($_POST) == 0) {
            echo json_encode(array(
                "message" => 'Warning: Empty Check Field!',
                "status"  => "warning"
            ));
            die();
        }

        try {
            for ($i = 0; $i < count($_POST); $i++) {

                if ($_POST[$i] != 'on') {
                    $obj = Trucks::find($_POST[$i]);
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
