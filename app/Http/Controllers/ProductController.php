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
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Add image validation rules
                'category' => ['required'],
            ]);

            // Handle file upload
            $imagePath = $request->file('image')->store('public/images'); // Save to storage

            // Get the URL for the saved image
            $imageUrl = asset(str_replace('public', 'storage', $imagePath));

            $addItem = Items::create([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'on_homepage' => $request->on_homepage,
                'tag' => $request->tag,
                'image' => $imageUrl, // Save the image URL in the database
                'description' => $request->description,
            ]);

            $items = Items::get();
            return redirect()->route('items.list');
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function edit($id)
    {
        try {
            $item = Items::find($id);
            $categories = Categories::get();
            // dd($item);
            return view('products.edit', ['item' => $item, 'categories' => $categories]);
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

            $item = Items::find($id);
            $item->name = $request->name;
            $item->price = $request->price;
            $item->image = $request->image;
            $item->tag = $request->tag;
            $item->description = $request->description;
            $item->save();

            $items = Items::get();
            return redirect()->route('items.list');
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function destroy($id)
    {
        try {
            $item = Items::find($id);
            $item->delete();

            $items = Items::get();
            return view('products.list', ['items' => $items]);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

}
