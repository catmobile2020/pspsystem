<?php

namespace App\Http\Controllers;

use App\Card;
use App\Governorate;
use App\Http\Requests\DoctorRequest;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->doctor()->latest()->paginate(20);
        return view('pages.doctor.index',compact('rows'));
    }

    public function create()
    {
        $doctor = new User();
        $governorates = Governorate::all();
        return view('pages.doctor.form',compact('doctor','governorates'));
    }


    public function store(DoctorRequest $request)
    {
        $exists_code = User::query()->pluck('doctor_code')->toArray();
        $doctor_code = rand(000,999);
        while (true)
        {
            if (in_array($doctor_code,$exists_code))
            {
                $doctor_code = rand(111,999);
            }else
            {
                break;
            }
        }
        $inputs = $request->all();
        $inputs['type'] = 4;
        $inputs['doctor_code'] = $doctor_code;
        $inputs['call_center_id'] = auth('callcenter')->id();
        $doctor = User::create($inputs);
        for($i=0;$i<100;$i++)
        {
            $patient_code = $doctor_code.($i%9).rand(11111,99999);
            Card::create([
                'serial' =>$patient_code,
                'doctor_id' =>$doctor->id
            ]);
        }

        return redirect()->route('doctors.index')->with('message','Done Successfully');
    }

    public function edit(User $doctor)
    {
        $governorates = Governorate::all();
        return view('pages.doctor.form',compact('doctor','governorates'));
    }


    public function update(DoctorRequest $request, User $doctor)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $doctor->update($request->all());
        return redirect()->route('doctors.index')->with('message','Done Successfully');
    }


    public function destroy(User $doctor)
    {
        $doctor->cards()->delete();
        $doctor->delete();
        return redirect()->route('doctors.index')->with('message','Done Successfully');
    }

    public function getPatients()
    {
        $doctor = auth('web')->user();
        $rows = User::where('doctor_id',$doctor->id)->latest()->paginate(20);
        return view('pages.doctor.patients',compact('rows', 'doctor'));
    }

    public function cards(User $doctor)
    {
        $rows = $doctor->cards;
        return view('pages.doctor.cards',compact('rows', 'doctor'));
    }
}
