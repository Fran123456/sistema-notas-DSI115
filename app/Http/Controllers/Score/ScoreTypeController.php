<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ScoreType;

class ScoreTypeController extends Controller
{
    public function scoreType(){
    	$years = array();
    	return view('score.type.scoretypes', compact('years'));
    }

    public function crateScoreType(){
    	return view('score.type.scoretypesCreate');
    }
}
