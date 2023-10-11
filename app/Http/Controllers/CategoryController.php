<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $items = Categories::get();

            return view('categories.list', ['items' => $items]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function addCatogory()
    {
        return view('categories.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
            ]);

            $addItem = Categories::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $request->image
            ]);

            $items = Categories::get();
            return view('categories.list', ['items' => $items]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }
}
