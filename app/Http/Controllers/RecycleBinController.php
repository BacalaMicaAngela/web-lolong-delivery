<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeletedUser;

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
        $deletedUsers = DeletedUser::all();

        // Pass $deletedUsers to the view or perform other actions
        return view('pages.recycleBin', compact('deletedUsers'));
    }
}

