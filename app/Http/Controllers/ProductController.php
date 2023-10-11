<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class ProductController extends Controller
{
    public function index()
    {
        try {
            $items = Items::get();

            return view('products.list', ['items' => $items]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function addItem()
    {
        $categories = Categories::get();
        return view('products.add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'image' => ['required'],
                'category' => ['required']
            ]);

            $addItem = Items::create([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'image' => $request->image,
                'description' => $request->description
            ]);

            $items = Items::get();
            return view('products.list', ['items' => $items]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }
}
