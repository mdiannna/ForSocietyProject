<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;

class BeforeEarthquakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
      return  view('before-earthquake.index');
    }
}
