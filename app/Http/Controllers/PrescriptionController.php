<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PrescriptionController extends Controller
{
    public function index(){
        return view('prescription.index');
    }
}
