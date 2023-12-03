<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Hash;

class DriverContoller extends Controller
{

    public function manageDriver(Request $request)
    {
        try {
            if (empty($request->driver_id)) {
                $obj = new Driver();
                $obj->driver_name    = $request->name;
                $obj->age            = $request->age;
                $obj->driver_phone   = $request->mobile;
                $obj->driver_address = $request->address;
                $obj->license_no     = $request->licenseno;
               

                $msg = 'save';
            } else {
                $obj = Driver::find($request->driver_id);
                $obj->driver_name    = $request->name;
                $obj->age            = $request->age;
                $obj->driver_phone   = $request->mobile;
                $obj->driver_address = $request->address;
                $obj->license_no     = $request->licenseno;
                $obj->driver_id      = $request->driver_id;
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

    public function showDriver($id)
    {
        try {
            echo json_encode(array(
                "message" => Driver::where('driver_id', '=', $id)->get(),
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function destroyDriver(Request $request)
    {
        if (count($_POST) == 0) 
        {
            echo json_encode(array(
                "message" => 'Warning: Empty Check Field!',
                "status"  => "warning"
            ));
            die();
        }

        try {
            for ($i = 0; $i < count($_POST); $i++) {

                if ($_POST[$i] != 'on') 
                {
                    $obj = Driver::find($_POST[$i]);
                    $res = $obj->delete();
                }
            }

            if ($res) 
            {
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

    public function actionDriver(Request $request, $id, $type)
{
    $obj = Driver::find($id);
    $obj->status = $type;
    $res = $obj->save();
    $msg = $type == 0 ? 'Active' : 'Inactive';

    if ($res) {
        return response()->json([
            "message" => "Set $msg User Successfully.",
            "status"  => "success"
        ]);
    } else {
        return response()->json([
            "message" => 'Something wrong!.',
            "status"  => "error"
        ]);
    }
}
public function removeDriver(Request $request, $id)
    {
        // Implement logic to remove the driver with the given $id
        // For example:
        $driver = Driver::find($id);
        $driver->delete();

        return response()->json([
            'message' => 'Driver removed successfully.',
            'status' => 'success',
        ]);
    }

    public function restoreDriver(Request $request, $id)
    {
        // Implement logic to restore the driver with the given $id
        // For example:
        $driver = Driver::withTrashed()->find($id);
        $driver->restore();

        return response()->json([
            'message' => 'Driver restored successfully.',
            'status' => 'success',
        ]);
    }
}