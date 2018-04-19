<?php

namespace App\Http\Controllers;

use App\Call;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    public function call(Request $request)
    {
        try {
            $call = new Call();
            $call->userId = Auth::user()->id;
            $call->from = $request->from;
            $call->to = $request->to;
            $call->status = "pending";
            $call->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function status()
    {
        $calls = Call::where('ueerId', Auth::user()->id)->get();

    }

    public function decline(Request $request)
    {
        try {
            Call::where('id', $request->id)->update([
                'status' => 'cancel'
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function confirm(Request $request){
        try {
            Call::where('id', $request->id)->update([
                'status' => 'confirm'
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}





