<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Deliver;
use App\Models\Driver;
use App\Models\Trucks;
use Session;
use App\Models\User;
use DB;

class AdminLinkController extends Controller
{
    public function billingState()
    {
        return view('pages.billingState', [
            "fetch"  => Billing::orderBy('billing_id', 'DESC')->get(),
            "data"   => $this->user(),
            "billing" => "active"
        ]);
    }

    public function driver()
    {
       
        return view('pages.driver', [
            "fetch"  => Driver::orderBy('driver_id', 'DESC')->get(),
            "data"   => $this->user(),
            "driver" => "active"
        ]);
    }

    public function truck()
    {
        return view('pages.truck', [
            "fetch"  => Trucks::orderBy('truck_id', 'DESC')->get(),
            "data"   => $this->user(),
            "trucks" => "active"
        ]);
    }

    public function maintenace()
    {
        $group = DB::table('tbl_maintenace')
        ->join('tbl_driver','tbl_driver.driver_id','=','tbl_maintenace.driver_id')
        ->join('tbl_truck_units','tbl_truck_units.truck_id','=','tbl_maintenace.truck_id')
        ->get();

        return view('pages.maintenace', [
            "fetch"       => $group,
            "driverData"  => Driver::orderBy('driver_id', 'DESC')->get(),
            "truckData"   => Trucks::orderBy('truck_id', 'DESC')->get(),
            "data"        => $this->user(),
            "maintenace"  => "active"
        ]);
    }

    public function records()
    {
        $group = DB::table('tbl_delivery')
        ->join('tbl_driver','tbl_driver.driver_id','=','tbl_delivery.driver_id')
        ->join('tbl_truck_units','tbl_truck_units.truck_id','=','tbl_delivery.truck_id')
        ->get();

        return view('pages.records', [
            "fetch"       => $group,
            "driverData"  => Driver::orderBy('driver_id', 'DESC')->get(),
            "truckData"   => Trucks::orderBy('truck_id', 'DESC')->get(),
            "data"        => $this->user(),
            "records"     => "active"
        ]);
    }

    public function schedule()
    {
        $group = DB::table('tbl_schedule')
        ->join('tbl_delivery','tbl_delivery.deliver_id','=','tbl_schedule.deliver_id')
        ->get();

        return view('pages.schedule', [
            "fetch"        => $group,
            "deliverData"  => Deliver::orderBy('deliver_id', 'DESC')->get(),
            "data"         => $this->user(),
            "schedule"     => "active"
        ]);
    }

    public function userLists()
    {
        $user = User::where('userType', '=', 1)->orwhere('userType', '=', 2)->orwhere('userType', '=', 3)->orwhere('userType', '=', 4)->orwhere('userType', '=', 5)->orwhere('userType', '=', 6)->orwhere('userType', '=', 7)->orwhere('userType', '=', 8)->orderBy('user_id', 'DESC')->get();

        return view('pages.adminUserLists', [
            "userDatas" => $user,
            "data"      => $this->user(),
            "user"      => "active"
        ]);
    }

    public function auditLog()
    {
        $log = AuditLog::get();

        return view('pages.adminAuditLog', [
            "dataLog"  => $log,
            "data"      => $this->user(),
            "auditLog"  => "active"
        ]);
    }

    public function adminSettings()
    {

        return view('pages.adminSettings', [
            "data"         => $this->user(),
            'tablesList'   => json_decode(json_encode(DB::select('SHOW TABLES')), true),
            'settings'     => 'active'
        ]);
    }

    public function user()
    {
        if (Session::has('loginId')) {
            return User::where('user_id', '=', Session::get('loginId'))->first();;
        }
    }
}
