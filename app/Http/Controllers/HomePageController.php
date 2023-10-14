<?php

namespace App\Http\Controllers;

use App\Models\BookTable as ModelsBookTable;
use App\Models\Items;
use App\Models\User;
use App\Notifications\BookTable;
use App\Notifications\BookTableAdmin;
use Exception;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use stdClass;

class HomePageController extends Controller
{
    public function welcome()
    {
        // dd('ok');
        $items = Items::where('on_homepage', '=', 1)
            ->get();
        if (count($items) > 0) {
            $items->each(function ($item) {
                $item->image = Str::after($item->image, 'storage');
            });
        }
        // dd('ok');
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
            $user->message = $request->message;

            Log::info('Email > ' . json_encode($user));

            $bookTable = ModelsBookTable::where('email', $request->email_address)->first();

            if (!isset($bookTable->email)) {
                $bookTable = ModelsBookTable::create(['email' => $request->email_address]);
            }
            $admin = User::where('isAdmin', 1)->first();

            $bookTable->notify(new BookTable($user));
            $admin->notify(new BookTableAdmin($user));
            return redirect()->route('welcome');
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return redirect()->back();
        }
    }
}
