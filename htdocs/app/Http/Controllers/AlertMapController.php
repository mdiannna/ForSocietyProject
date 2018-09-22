<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;

class AlertMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maps.alert');
    }

    public function putMarkers()
    {
        $markers = Pin::where('pin_type_id', 1)->get();
        // return view('put_markers_map', compact('markers'));
         return view('maps.alert', compact('markers'));
    }
    

    // save pin to database
    public function saveMarker(Request $request)
    {
        $p = Pin::create($request->except(['message', '_token']));

        // Alert::info('Alerta adaugata pe harta');

        $response = array(
          'status' => 'success',
          'msg' => $request->message . $request->details .'added',
          'message' => 'Alerta adaugata pe harta',
          'message-type' => 'success'
        );

        $request->session()->flash('message', 'Alerta adaugata pe harta.');
        $request->session()->flash('message-type', 'success');

        return response()->json($response); 
    }
}
