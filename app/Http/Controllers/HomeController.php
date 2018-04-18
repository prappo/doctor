<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == "admin") {
            return view('user.adminHome');
        } elseif (Auth::user()->type == "patient") {
            return view('user.patientHome');

        } elseif (Auth::user()->type == "doctor") {
            return view('user.doctorHome');
        }

    }
}
