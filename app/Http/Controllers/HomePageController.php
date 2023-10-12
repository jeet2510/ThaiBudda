<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Notifications\BookTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use stdClass;

class HomePageController extends Controller
{
    public function welcome()
    {
        $items = Items::select('name', 'price', 'description', 'image')->get();
        // dd($items);
        return view('welcome', compact('items'));
    }

    public function bookTable(Request $request)
    {
        try {
            // dd($request->name . ' ' . $request->phone . ' ' . $request->email_address . ' ' . $request->get('reservation-date') . ' Pr >>' . $request->get('person') . ' -- ' . $request->time);

            $user = new stdClass();

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email_address;
            $user->reservation_date = $request->get('reservation-date');
            $user->person = $request->person;
            $user->time = $request->time;

            Notification::route('mail', $request->email_address)
                ->notify(new BookTable($user));
            return view('welcome');
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }
}
