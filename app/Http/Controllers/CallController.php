<?php

namespace App\Http\Controllers;

use App\Call;
use App\Feedback;
use App\Prescription;
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
            $call->p_seen = "no";
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
                'job_time' => $request->time,
                'p_txt' => $request->pTxt
            ]);

            $pId = rand(1000, 9999);

            $prescription = new Prescription();
            $prescription->pId = $pId;
            $prescription->from = Call::where('id', $request->id)->value('from');
            $prescription->to = Call::where('id', $request->id)->value('to');
            $prescription->rx = $request->pTxt;
            $prescription->chief_complaints = $request->chiefComplaint;
            $prescription->general_examinations = $request->generalExaminations;
            $prescription->advice_for_investigations = $request->adviceForInvestigations;
            $prescription->advice = $request->advice;
            $prescription->next_visit_date = $request->date;
            $prescription->sex = $request->sex;
            $prescription->age = $request->age;
            $prescription->save();

            Call::where('id', $request->id)->update([
                'pId' => $pId
            ]);

            return response()->json([
                'status' => 'success',
                'pId' => $pId,
                'msg' => ''
            ]);
        } catch (\Exception $exception) {

            return response()->json([
                'status' => 'error',
                'msg' => $exception->getMessage()
            ]);


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
            $doctorId = Call::where('id', $request->id)->value('to');
            $patientId = Call::where('id', $request->id)->value('from');
            Call::where('id', $request->id)->update([
                "feedback_seen" => "yes"
            ]);


            return response()->json([
                'msg' => 'done',
                'doctorName' => $doctorName,
                'doctorContact' => $doctorContact,
                'pId' => Call::where('id', $request->id)->value('pId'),
                'doctorId' => $doctorId,
                'patientId' => $patientId
            ]);
        }

        if (Call::where('id', $request->id)->value('status') == "done" && Call::where('id', $request->id)->value('p_seen') == "no") {
            $pTxt = Call::where('id', $request->id)->value('p_txt');


            Call::where('id', $request->id)->update([
                "p_seen" => "yes"
            ]);

            return response()->json([
                'msg' => 'p_seen',
                'p_text' => $pTxt,
                'pId' => Call::where('id', $request->id)->value('pId')

            ]);
        }


    }


    public function feedback(Request $request)
    {
        try {
            $feedback = new Feedback();
            $feedback->userId = Auth::user()->id;
            $feedback->docId = $request->doctorId;
            $feedback->comment = $request->comment;
            $feedback->save();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function viewFeedback()
    {
        if (Auth::user()->type == "admin") {
            $datas = Feedback::all();
            return view('user.feedbacks', compact('datas'));
        } elseif (Auth::user()->type == "Doctor") {
            $datas = Feedback::where('docId', Auth::user()->id)->get();
            return view('user.feedbacks', compact('datas'));

        } elseif (Auth::user()->type == "Patient") {
            $datas = Feedback::where('userId', Auth::user()->id)->get();
            return view('user.feedbacks', compact('datas'));
        }
    }


}









