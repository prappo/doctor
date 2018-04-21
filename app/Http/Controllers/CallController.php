<?php

namespace App\Http\Controllers;

use App\Call;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    public function call(Request $request)
    {
        if (Call::where('userId', Auth::user()->id)->where('from', $request->from)->where('to', $request->to)->where('status', 'pending')->exists()) {
            return "You already sent request";
        }
        try {
            $call = new Call();
            $call->userId = Auth::user()->id;
            $call->from = $request->from;
            $call->to = $request->to;
            $call->status = "pending";
            $call->seen = "no";
            $call->confirmation_seen = "no";
            $call->feedback_seen = "no";
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

    public function confirm(Request $request)
    {
        try {
            Call::where('id', $request->id)->update([
                'status' => 'confirm'
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function done(Request $request)
    {
        try {
            Call::where('id', $request->id)->update([
                'status' => 'done',
                'job_time' => $request->time
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function sync(Request $request)
    {
        if (Call::where('id', $request->id)->value('status') == "confirm" && Call::where('id', $request->id)->value('confirmation_seen') == "no") {
            $doctorName = User::where('id', Call::where('id', $request->id)->value('to'))->value('name');
            $doctorContact = User::where('id', Call::where('id', $request->id)->value('to'))->value('skype');

            Call::where('id', $request->id)->update([
                "confirmation_seen" => "yes"
            ]);

            return response()->json([
                'msg' => 'confirm',
                'doctorName' => $doctorName,
                'doctorContact' => $doctorContact
            ]);

        }

        if (Call::where('id', $request->id)->value('status') == "done" && Call::where('id', $request->id)->value('feedback_seen') == "no") {
            $doctorName = User::where('id', Call::where('id', $request->id)->value('to'))->value('name');
            $doctorContact = User::where('id', Call::where('id', $request->id)->value('to'))->value('skype');

            Call::where('id', $request->id)->update([
                "feedback_seen" => "yes"
            ]);

            return response()->json([
                'msg' => 'done',
                'doctorName' => $doctorName,
                'doctorContact' => $doctorContact
            ]);
        }



    }


}





