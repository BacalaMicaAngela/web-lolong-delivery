<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\CheckInputController;
use App\Models\User;
use Hash;

class UserController extends Controller
{

    public function updateUser(Request $request)
    {
        $chk = new CheckInputController();
        $chk->checkInput($_POST);
        if ($_POST['password'] != $_POST['cpassword']) {
            echo json_encode(array(
                "message" => "Password not match!",
                "status"  => "warning"
            ));
            die();
        }

        try {
            $uploader = new UploaderController();
            $obj = User::find($request->user_id);

            if ($_FILES['file']['error'] != 4) {
                $file = $uploader->uploader($_FILES['file'], './uploads/');
                $obj->u_name          = $request->u_name;
                $obj->username        = $request->username;
                $obj->password        = Hash::make($request->password);
                $obj->user_avatar     = $file;
                $res = $obj->save();
            } else {
                $obj->u_name     = $request->u_name;
                $obj->username   = $request->username;
                $obj->password   = Hash::make($request->password);
                $res = $obj->save();
            }

            if ($res) {
                echo json_encode(array(
                    "message" => "Update Account Successfully!.",
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

    public function manageUser(Request $request)
    {
        $uploader = new UploaderController();

        if (empty($request->user_id)) {
            $file = ($_FILES['file']['error'] != 4) ? $uploader->uploader($_FILES['file'], './uploads/') : 'default.png';
            $this->newUser(
                $request,
                $file
            );
        } else {
            $file = ($_FILES['file']['error'] != 4) ? $uploader->uploader($_FILES['file'], './uploads/') : '';
            $this->updateListUser(
                $request,
                $file
            );
        }
    }

    public function newUser($request, $file)
    {
        try {
            $obj = new User();
            $obj->u_name          = $request->u_name;
            $obj->username        = $request->username;
            $obj->password        = Hash::make($request->password);
            $obj->userType        = $request->userType;
            $obj->status          = 0;
            $obj->user_avatar     = $file;
            $res = $obj->save();

            if ($res) {
                echo json_encode(array(
                    "message" => "New User Successfully!.",
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

    public function updateListUser($request, $file)
    {
        try {
            $obj = User::find($request->user_id);

            if (empty($file)) {
                $obj->u_name     = $request->u_name;
                $obj->username   = $request->username;
                $obj->password   = Hash::make($request->password);
                $obj->userType   = $request->userType;
                $res = $obj->save();
            } else {
                $obj->u_name          = $request->u_name;
                $obj->username        = $request->username;
                $obj->password        = Hash::make($request->password);
                $obj->userType        = $request->userType;
                $obj->user_avatar     = $file;
                $res = $obj->save();
            }

            if ($res) {
                echo json_encode(array(
                    "message" => "Update User Successfully!.",
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

    public function showUser($id)
    {
        try {
            echo json_encode(array(
                "message" => User::where('user_id', '=', $id)->get(),
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    // public function destroyUser(Request $request)
    // {

    //     if (count($_POST) == 0) {
    //         echo json_encode(array(
    //             "message" => 'Warning: Empty Check Field!',
    //             "status"  => "warning"
    //         ));
    //         die();
    //     }

    //     try {
    //         for ($i = 0; $i < count($_POST); $i++) {

    //             if ($_POST[$i] != 'on') {
    //                 $obj = User::find($_POST[$i]);
    //                 $res = $obj->delete();
    //             }
    //         }

    //         if ($res) {
    //             echo json_encode(array(
    //                 "message" => 'Remove successfully.',
    //                 "status"  => "success"
    //             ));
    //         }
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         echo json_encode(array(
    //             "message" => "Error: " . $e->getMessage(),
    //             "status"  => "error"
    //         ));
    //     }
    // }

    public function actionUser($id, $type)
    {
        $obj = User::find($id);
        $obj->status = $type;
        $res = $obj->save();
        $msg = $type == 0 ? 'Active' : 'Inactive';

        if ($res) {
            echo json_encode(array(
                "message" => "Set $msg User Successfully.",
                "status"  => "success"
            ));
        } else {
            echo json_encode(array(
                "message" => 'Something wrong!.',
                "status"  => "error"
            ));
        }
    }
    public function destroyUser(Request $request)
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
                    $user = User::find($_POST[$i]);
                    $user->delete(); // Soft delete
                }
            }

            echo json_encode(array(
                "message" => 'Move to Recycle Bin successfully.',
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function restoreUser(Request $request, $id)
    {
        try {
            // Restore soft-deleted user
            $user = User::withTrashed()->where('user_id', $id)->restore();
            echo json_encode(array(
                "message" => 'User restored successfully.',
                "status"  => "success"
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }
}
