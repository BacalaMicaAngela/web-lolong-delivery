<?php

namespace App\Http\Controllers;

use App\Models\Deliver;
use App\Models\Driver;
use App\Models\Maintenace;
use App\Models\Schedule;
use App\Models\Trucks;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class TilesController extends Controller
{
    public function pageHome()
    {
        $group = [
            0 => Trucks::all()->count(),
            1 => Driver::all()->count(),
            2 => Deliver::all()->count(),
            3 => Schedule::all()->count(),
            4 => Maintenace::all()->count(),
            5 => User::all()->count()
        ];

        $graph = [
            1 => $this->compute('01'),
            2 => $this->compute('02'),
            3 => $this->compute('03'),
            4 => $this->compute('04'),
            5 => $this->compute('05'),
            6 => $this->compute('06'),
            7 => $this->compute('07'),
            8 => $this->compute('08'),
            9 => $this->compute('09'),
            10 => $this->compute('10'),
            11 => $this->compute('11'),
            12 => $this->compute('12')
        ];

        return view("pages.tile", [
            "data"      => $this->user(),
            "graphData" => $graph,
            "pieData"   => $group,
            "home"      => "active"
        ]);
    }

    public function compute($month)
    {
        $addDate = json_decode(Deliver::all(), true);
        $coun = 0;

        foreach ($addDate as $row) {
            $monthGet = date('m', strtotime($row['created_at']));
            if ($monthGet == (int) $month) {
                $coun++;
            }
        }
        return $coun;
    }

    public function user()
    {
        $userId = Session::get('loginId');

        return User::where('user_id', '=', $userId)->first();
    }
}
