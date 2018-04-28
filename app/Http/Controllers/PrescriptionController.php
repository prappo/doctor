<?php

namespace App\Http\Controllers;

use App\Prescription;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

use App\Http\Requests;

class PrescriptionController extends Controller
{
    public function index(){
        return view('prescription.index');
    }

    public function getPrescription(Request $request){
        $datas = Prescription::where('pId',$request->pId)->get();
        return view('prescription.index',compact('datas'));

    }


}
