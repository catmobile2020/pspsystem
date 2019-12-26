<?php

namespace App\Http\Controllers;

use App\Card;
use App\Governorate;
use App\Http\Requests\PatientRequest;
use App\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->patient()->latest()->paginate(20);
        return view('pages.patient.index',compact('rows'));
    }

    public function create()
    {
        $auth_user =auth('callcenter')->user();
        $patient = new User();
        $governorates = Governorate::all();
        $doctors = User::doctor()->where('call_center_id',$auth_user->id)->get();
        return view('pages.patient.form',compact('patient','doctors', 'governorates'));
    }


    public function store(PatientRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = 1;
        $inputs['call_center_id'] = auth('callcenter')->id();
        $card = Card::where('serial',$request->serial_number)->first();
        if (!$card)
        {
            return redirect()->back()->with('message','Patient Card Wrong. Try Again!');
        }
        $patient =  User::create($inputs);
        $message = "تهانينا على انضمام لبرنامج ايدك فى ايدينا";
        $this->sendSMS($patient->phone,$message);
        return redirect()->route('patients.index')->with('message','Done Successfully');
    }

    public function edit(User $patient)
    {
        $auth_user =auth('callcenter')->user();
        $governorates = Governorate::all();
        $doctors = User::doctor()->where('call_center_id',$auth_user->id)->get();
        return view('pages.patient.form',compact('patient','programs', 'doctors', 'governorates'));
    }


    public function update(PatientRequest $request, User $patient)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $card = Card::where('serial',$request->serial_number)->first();
        if (!$card)
        {
            return redirect()->back()->with('message','Patient Card Wrong. Try Again!');
        }
        $inputs = $request->all();
        $patient->update($inputs);
        return redirect()->route('patients.index')->with('message','Done Successfully');
    }


    public function destroy(User $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('message','Done Successfully');
    }

    public function checkSerial(Request $request)
    {
        $card = Card::where('serial',$request->serial)->first();
        if ($card)
        {
            $governorate_id = $card->doctor->governorate_id;
            return [
                'status'=>true,
                'message'=>"Valid Card",
                'data'=>['doctor_id'=>$card->doctor_id,'governorate_id'=>$governorate_id]
            ];
        }
        return ['status'=>false,'message'=>"Patient Card Wrong. Try Again!"];
    }
}
