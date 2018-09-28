<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;

class SensorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
      return  response()->json("Hello!");
    }

    public function about() 
    {
    	return view('hardware.about');
    }
}
