<?php

namespace App\Http\Controllers;

use App\Models\Deliver;
use App\Models\Schedule;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function viewsched($id)
    {
        $sched = DB::table('tbl_schedule')
            ->join('tbl_delivery', 'tbl_delivery.deliver_id', '=', 'tbl_schedule.deliver_id')
            ->where('tbl_schedule.schedule_id', '=', $id)
            ->get();


        if (
            count($sched) == 0
        ) {
            return response()->json([
                'message' => 'Not Found data.',
                'status'  => 'warning'
            ]);
            dd();
        }

        $covertId = json_decode($sched, true)[0]['deliver_id'];

        $deliver = DB::table('tbl_delivery')
            ->join('tbl_driver', 'tbl_driver.driver_id', '=', 'tbl_delivery.driver_id')
            ->join('tbl_truck_units', 'tbl_truck_units.truck_id', '=', 'tbl_delivery.truck_id')
            ->where('tbl_delivery.deliver_id', '=', $covertId)
            ->get();

        $group = [
            "sched"    => $sched,
            "deliver"  => $deliver,
        ];

        return response()->json([
            'message' => $group,
            'status'  => 200
        ]);
    }


    public function manageSchedule(Request $request)
    {
        try {
            if (empty($request->id)) {

                // $obj = Schedule::find($request->deliver_id);

                $sched = Schedule::where('deliver_id', '=',$request->deliver_id)->get();

                $delId =isset(json_decode($sched, true)[0]['deliver_id']) ? json_decode($sched, true)[0]['deliver_id'] : null;


                if ($delId == (int)$request->deliver_id) {
                    echo json_encode(array(
                        "message" => "Scheduled Delivery Already Exist.",
                        "status"  => "warning"
                    ));
                    dd();
                }

                $obj = new Schedule();
                $obj->deliver_id        = $request->deliver_id;
                $obj->bussiness_name    = $request->baname;
                $obj->delivery_address  = $request->daddress;
                $obj->contact_person    = $request->cperson;
                $obj->contactno         = $request->contactno;
                $obj->delivery_date     = $request->deleliveryDate;
                $obj->dispatch_by       = $request->dispatchby;
                $obj->dispatch_date     = $request->dispatchdate;
                $obj->recieve_by        = $request->reciveby;
                $obj->recieve_date      = $request->recivedate;
                $obj->hasno             = mt_rand(1000, 9999);

                $msg = 'save';
            } else {
                $obj = Schedule::find($request->id);

                $this->statusUpdate($request->status_id, $request->status);
                $obj->bussiness_name    = $request->baname;
                $obj->delivery_address  = $request->daddress;
                $obj->contact_person    = $request->cperson;
                $obj->contactno         = $request->contactno;
                $obj->delivery_date     = $request->deleliveryDate;
                $obj->dispatch_by       = $request->dispatchby;
                $obj->dispatch_date     = $request->dispatchdate;
                $obj->recieve_by        = $request->reciveby;
                $obj->recieve_date      = $request->recivedate;
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

    public function statusUpdate($id, $status)
    {
        $obj = Deliver::find($id);
        $obj->deliver_status = $status;

        return $obj->save();
    }

    public function showSchedule($id)
    {
        try {
            $sched = Schedule::where('schedule_id', '=', $id)->get();

            $iddeleiver = json_decode($sched, true)[0]['deliver_id'];

            $group = [
                'sched'  => $sched,
                'deliver' => Deliver::where('deliver_id', '=', $iddeleiver)->get()
            ];

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

    public function destroySchedule(Request $request)
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
                    $obj = Schedule::find($_POST[$i]);
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
