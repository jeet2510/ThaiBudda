<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function welcome()
    {
        $items = Items::select('name', 'price', 'description', 'image', 'tag')
                        ->where('on_homepage','=',1)
                        ->get();
        $items->each(function($item) {
            $item->image = Str::after($item->image, 'storage');
        });
        // dd($items);
        return view('welcome', compact('items'));
    }
}
