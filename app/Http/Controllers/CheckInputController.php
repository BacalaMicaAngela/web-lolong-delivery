<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckInputController extends Controller
{
    public function checkInput($data) {
        foreach ($data as $value) {
            if(empty($value)
            ) {
                echo json_encode(array(
                    "message" => "Warning: Fill up all the required fields.",
                    "status"  => "warning"
                ));
                die();
            }
        }
    }
}
