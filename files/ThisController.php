<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThisController extends Controller
{
    //
    public function index(Request $req)
    {
        
        return view("this", ['name'=> "mozdalif sikder", "age"=> ["none"=>23, "age"=>24]]);
    }
}
