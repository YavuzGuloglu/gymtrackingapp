<?php

namespace App\Http\Controllers\Api\Desktop;

use Auth;
use App\User;
use App\Dates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function users()
    {
        $user = User::where('admin', 0)->get();
        return response()->json($user);
    }

    public function dates()
    {
        $dates = Dates::get();
        return response()->json($dates);
    }

    public function ekle(Request $request)
    {
        $user = User::add([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Dates::add([
            'user_id' => $user->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json(['durum' => true]);
    }

    public function guncelle(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['durum' => true]);
    }

    public function sil($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['durum' => true]);
    }
}