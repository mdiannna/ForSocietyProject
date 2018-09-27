<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;

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
}
