<?php

namespace App\Http\Controllers;

use App\Prescription;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        return view('prescription.index');
    }

    public function getPrescription(Request $request)
    {
        $datas = Prescription::where('pId', $request->pId)->get();
        return view('prescription.index', compact('datas'));

    }

    public function getPrescriptionById($pId)
    {
        $datas = Prescription::where('pId', $pId)->get();
        return view('prescription.template', compact('datas'));

    }

    public function myPrescriptions()
    {
        if (Auth::user()->type == "Patient") {
            $datas = Prescription::where('from',Auth::user()->id)->get();
            return view('prescription.list', compact('datas'));
        } elseif (Auth::user()->type == "Doctor") {
            $datas = Prescription::where('to', Auth::user()->id)->get();
            return view('prescription.list', compact('datas'));
        } elseif (Auth::user()->type == "admin") {
            $datas = Prescription::all();
            return view('prescription.list', compact('datas'));
        }

    }


}
