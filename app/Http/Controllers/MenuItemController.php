<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(){
        $items = Items::select('name', 'price', 'description', 'image', 'tag')->get();
        // dd($items);
        return view('foodcategory', compact('items'));
    }
}
