<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    public function index(){
        $items = Items::select('name', 'price', 'description', 'image', 'tag')->get();
        // dd($items);
        if (count($items) > 0) {
            $items->each(function ($item) {
                $item->image = Str::after($item->image, 'storage');
            });
        }
        return view('foodcategory', compact('items'));
    }
}
