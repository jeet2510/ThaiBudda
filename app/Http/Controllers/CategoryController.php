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
            // dd($items);
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

    public function edit($id)
    {
        try {
            $categories = Categories::find($id);
            return view('categories.edit', ['item' => $categories]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'image' => ['required']
            ]);

            $category = Categories::find($id);
            // dd($category);
            $category->name = $request->name;
            $category->image = $request->image;
            $category->description = $request->description;
            $category->save();

            $Category = Categories::get();
            // dd($Category);
            return view('categories.list', ['items' => $Category]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }
}
