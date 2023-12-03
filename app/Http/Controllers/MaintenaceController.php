<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StoreUploadController;
use Illuminate\Support\Facades\Storage;
use App\Models\Maintenace;
use Carbon\Carbon;
use DB;


class MaintenaceController extends Controller
{
    public function manageMaintenace(Request $request)
    {
        try {
            $res = null;
    
            if ($request->hasFile('file')) {
                $request["uploaded_at"] = Carbon::now();
                $uploads = new StoreUploadController();
    
                $res = $uploads->storeUploadFile($request);
            }

            if (empty($request->id)) {
                $obj = new Maintenace();
                $obj->driver_id     = $request->driver;
                $obj->truck_id      = $request->truck;
                $obj->reciept_proof = $res;
                $obj->source_type   = $request->outsourced;

                $msg = 'save';
            } else {
                $obj = Maintenace::find($request->id);
                $obj->driver_id     = $request->driver;
                $obj->truck_id      = $request->truck;
                $obj->source_type   = $request->outsourced;

                if ($res != null) {
                    $obj->reciept_proof = $res;
                }

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

    public function showMaintenace($id)
    {
        try {
            $group = DB::table('tbl_maintenace')
                ->join('tbl_driver', 'tbl_driver.driver_id', '=', 'tbl_maintenace.driver_id')
                ->join('tbl_truck_units', 'tbl_truck_units.truck_id', '=', 'tbl_maintenace.truck_id')
                ->where('maintenace_id', '=', $id)
                ->get();

            echo json_encode(array(
                "message" => $group,
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function destroyMaintenace(Request $request)
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
                    $obj = Maintenace::find($_POST[$i]);
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

    public function downloadMaintenace($path)
{
    $filePath = storage_path("app/public/upload/$path");

    if (file_exists($filePath)) {
        return response()->download($filePath);
    } else {
        abort(404, 'File Not Found');
    }
}


    
}
