<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
            $user->email = $request->email;
            $user->type = $request->type;
            $user->password = bcrypt($request->password);
            $user->save();
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function updateUser(Request $request)
    {
        // update user information

        try {
            User::where('id', $request->userId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function deleteUser(Request $request)
    {
        // delete a user

        if (User::where('id', $request->userId)->value('type') == "admin") {
            return "You can't delete admin account";
        }
        try {
            User::where('id', $request->userId)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function viewUsers(Request $request){
        $users = User::all();
        return view('user.viewUsers',compact('users'));
    }

}






