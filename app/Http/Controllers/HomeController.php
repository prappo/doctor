<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == "admin") {
            $users = User::all();
            return view('user.adminHome', compact('users'));
        } elseif (Auth::user()->type == "Patient") {
            $doctors = User::where('type','Doctor')->get();
            return view('user.patientHome', compact('doctors'));

        } elseif (Auth::user()->type == "Doctor") {
            return view('user.doctorHome');
        }

    }

    public function doctors($cat){
        $doctors = User::where('type','Doctor')->where('cat',$cat)->get();
        return view('user.patientHome', compact('doctors'));
    }
}
