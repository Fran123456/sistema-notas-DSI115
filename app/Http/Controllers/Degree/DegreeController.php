<?php

namespace App\Http\Controllers\Degree;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Degree;

class DegreeController extends Controller
{
    public function index()
    {
        auth()->user()->authorizeRoles(['administrador']);
        $degrees = Degree::all();
        return view('degrees.degrees',["degrees"=>$degrees]);
    }

}
