<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class PatientOrderController extends Controller
{
    public function index()
    {
        $user = auth('web')->user();
        $rows = $user->patientOrders()->latest()->paginate(15);
        return view('pages.order.index',compact('rows'));
    }

    public function cards(User $doctor)
    {
        $rows = $doctor->cards;
        return view('pages.doctor.cards',compact('rows', 'doctor'));
    }


    public function productPatients()
    {
        $doctor = auth('web')->user();
        $rows = $doctor->patients()->latest()->paginate(15);
        return view('pages.doctor.patients',compact('doctor','rows'));
    }

    public function singlePatient(User $user)
    {
        $rows = $user->patientOrders()->latest()->paginate(15);
        return view('pages.order.index',compact('rows'));
    }
}
