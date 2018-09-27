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
        return view('alert_info.list', compact('pins'));
    }

    /**
      List info about buildings at risk
    */
    public function buildings() {
      $buildings = Building::all();
      return view('alert_info.buildings.list', compact('buildings'));

    }

    public function addBuilding() {
      return view('alert_info.buildings.add');
    }

    public function storeBuilding($request) {
      $building = new Building( $request->except(['message', '_token']));
      return redirect('/alert-info/buildings');
    }

    /**
      List info about buildings at risk
    */
    public function collapsedBuildings() {
      $buildings = Building::where('collapsed', 1)->get();
      return view('alert_info.buildings.list', compact('buildings'));
    }
}
