<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function welcome()
    {
        $items = Items::select('name', 'price', 'description', 'image', 'tag')->get();
        // dd($items);
        return view('welcome', compact('items'));
    }
}
