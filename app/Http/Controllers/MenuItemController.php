<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(){
        return view('foodcategory');
    }
}
