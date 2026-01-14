<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarifParkirController extends Controller
{
    public function index()
    {
        return view('admin.tarif_parkir.index');
    }

    public function create()
    {
        return view('admin.tarif_parkir.create');
    }
}
