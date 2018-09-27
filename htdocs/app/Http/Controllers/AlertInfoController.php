<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use App\Models\Building;


class AlertInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = Pin::whereNotNull('sentiment')->orderByDesc('emotions_coefficient')->orderBy('sentiment')->get();
        return view('alert-info.list', compact('pins'));
    }

    /**
    List info about buildings at risk
    */
    public function buildings() {
      $buildings = Building::all();
      return view('alert-info.buildings.list', compact('buildings'));

    }

    public function collapsedBuildings() {

    }
}
