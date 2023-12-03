<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Session;
use DB;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function loginUser(Request $request) {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $user = User::where('username', '=', $request->username)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)
            ) {
                if($user->status == 1) {
                    return back()->with('failed', 'This account is Inactive!.');
                }

                if ($user->userType > 0) {
                    $this->logs(
                        $user->user_avatar,
                        'in',
                        $user->u_name,
                        $user->userType,
                        $user->user_id
                    );
                }

                $request=session()->put('loginId', $user->user_id);

                return redirect('pages');
            } else {
                return back()->with('failed', 'Password not match!.');
            }
        } else {
            return back()->with('failed', 'This username is not register!.');
        }
    }

    public function pageView() {
        if(Session::has('loginId')
        ) {
            $data = User::where('user_id', '=', Session::get('loginId'))->first();

            return view('pages.tiles', [
                "data" => $data
            ]);
        }
    }

    public function logout() {

        $user = User::where('user_id', '=', Session::get('loginId'))->first();

        if($user->userType > 0) {
            $this->logs(
                $user->user_avatar,
                'out',
                $user->u_name,
                $user->userType,
                $user->user_id
            );
        }

        if(Session::has('loginId')
        ) {
            Session::pull('loginId');

            return redirect('login');
        }
    }

    public function logs($avatar, $type, $name, $userType, $userId) {
        DB::insert('INSERT INTO auditlog (`avatar`, `fname`, `userType`, `logType`, `user_id`, `create_date`)VALUE(?,?,?,?,?,NOW())', [
            $avatar,
            $name,
            $userType,
            $type,
            $userId
        ]);
    }
}
