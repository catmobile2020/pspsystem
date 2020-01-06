<?php

namespace App\Http\Controllers;

use App\Company;
use App\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('pages.welcome');
    }

    public function index()
    {
        $companies = Company::all();
        return view('pages.home',compact('companies'));
    }

    public function myPrograms()
    {
        $programs = Program::all();
        return view('pages.novartis',compact('programs'));
    }
}
