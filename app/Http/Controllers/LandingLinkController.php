<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingLinkController extends Controller
{
    public function index() {
        return view('index', [
            "home"          => 'active'
        ]);
    }

    public function kasambahay() {
        return view('kasambahayForm',[
            "kasambahayPage" => 'active'
        ]);
    }

    public function soloParent() {
        return view('soloParentForm',[
            "soloPage" => 'active'
        ]);
    }

    public function seniorCitizen() {
        return view('seniorCitizenForm',[
            "senior" => 'active'
        ]);
    }

    public function kalipi() {
        return view('kalipiForm',[
            "kalipi" => 'active'
        ]);
    }

    public function disability() {
        return view('disabilityForm',[
            "disability" => 'active'
        ]);
    }

    public function personel() {
        $bulletin = new bulletinController();
        return view('personel', [
            "bulletinDatas" => $bulletin->bulletinListAllTable(),
        ]);
    }

    public function disaster() {
        return view('disasterForm',[
            "disaster" => 'active'
        ]);
    }

    public function specialProtectiveServices() {
        return view('specialProtectiveForm',[
            "protective" => 'active'
        ]);
    }

    public function family() {
        return view('familyForm',[
            "family" => 'active'
        ]);
    }
}
