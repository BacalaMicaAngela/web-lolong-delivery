<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeletedUser;
use Session;

class RecycleBinController extends Controller
{
    public function showRecycleBinPage()
    {
        // Fetch deleted users (or any other deleted items you want to display)
        $deletedUsers = User::onlyTrashed()->get();

       

        // Return the view with the deleted users
        return view('pages.recycleBin', ['deletedUsers' => $deletedUsers]);
    }

    public function index()
    {
        // $deletedUsers = DeletedUser::all();

        // // Pass $deletedUsers to the view or perform other actions
        // return view('pages.recycleBin', compact('deletedUsers'));

        $deletedUsers = User::onlyTrashed()->get();

        // Return the view with the deleted users
        return view('pages.recycleBin', ["data" => $this->user(), 'deletedUsers' => $deletedUsers]);
    }

    public function user()
    {
        if (Session::has('loginId')) {
            return User::where('user_id', '=', Session::get('loginId'))->first();;
        }
    }
}

