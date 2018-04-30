<?php

namespace App\Http\Controllers;

use App\Call;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        // check if email already exist
        if (User::where('email', $request->email)->exists()) {
            return "This Email already exist";
        }

        try {
            // creating a new user

            $user = new User();
            $user->name = $request->name;
            $user->bio = $request->bio1;
            $user->bio_bangla = $request->bio1_bangla;
            $user->bio_a = $request->bio2;
            $user->bio_a_bangla = $request->bio2_bangla;
            $user->email = $request->email;
            $user->type = $request->type;
            $user->skype = $request->skype;
            $user->password = bcrypt($request->password);
            $user->save();
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function addUserIndex()
    {
        if (Auth::user()->type == "admin") {
            return view('user.add');
        } else {
            return view('error.404');
        }
    }


    public function viewUsers()
    {
        return view('user.viewUsers');
    }

    public function editUser($id)
    {
        $data = User::where('id', $id)->first();
        return view('user.editUser', compact('data'));
    }


    public function updateUser(Request $request)
    {
        // update user information

        try {
            if ($request->password == "") {
                User::where('id', $request->userId)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'name_bangla' => $request->name_bangla,
                    'bio' => $request->bio1,
                    'bio_bangla' => $request->bio1_bangla,
                    'bio_a' => $request->bio2,
                    'bio_a_bangla' => $request->bio2_bangla,
                    'skype' => $request->skype
                ]);
            } else {
                User::where('id', $request->userId)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'name_bangla' => $request->name_bangla,
                    'bio' => $request->bio1,
                    'bio_bangla' => $request->bio1_bangla,
                    'bio_a' => $request->bio2,
                    'bio_a_bangla' => $request->bio2_bangla,
                    'skype' => $request->skype,
                    'password' => bcrypt($request->password)
                ]);
            }

            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function deleteUser(Request $request)
    {
        // delete a user

        if (User::where('id', $request->id)->value('type') == "admin") {
            return "You can't delete admin account";
        }
        try {
            User::where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function serviceLogs()
    {
        if (Auth::user()->type == "Doctor") {
            $data = Call::where('to', Auth::user()->id)->get();
            return view('user.serviceLog', compact('data'));
        } elseif (Auth::user()->type == "Patient") {
            $data = Call::where('from', Auth::user()->id)->get();
            return view('user.serviceLogPatient', compact('data'));
        } else {
            $data = Call::all();
            return view('user.serviceLogAdmin', compact('data'));
        }

    }

    public function profile()
    {
        return view('user.profile');
    }

    public function calls(){
        return view('request.index');
    }

}






