<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use DB;

class BillingController extends Controller
{
    public function manageBilling(Request $request)
    {
        try {
            $res = null;

            if ($request["file"]) {
                $file = new StoreUploadController();
                $res = $file->fileExcel($request);
            }

            if (empty($request->id)) {
                $obj = new Billing();
                $obj->billing_name = $request->billingname;
                $obj->billing_file = $res;

                $msg = 'save';
            } else {
                $obj = Billing::find($request->id);
                $obj->billing_name = $request->billingname;
                if($res != null) {
                    $obj->billing_file = $res;
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

    public function showBilling($id)
    {
        try {
            $group = DB::table('tbl_billing')
            ->where('billing_id', '=', $id)
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

    public function destroyBilling(Request $request)
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
                    $obj = Billing::find($_POST[$i]);
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

    public function downloadBill($path)
    {
        return response()->download(public_path('/upload/'.$path));
    }
}
