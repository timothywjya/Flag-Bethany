<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('profile.change-password');
    }

    public function UpdateNewPassword(Request $request)
    {
        try {
            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(["status" => "error", "message" => "Password lama yang anda masukan salah"], 400);
            }

            DB::table("users")
                ->where("id", Auth::user()->id)
                ->update(["password" => bcrypt($request->password)]);

            return response()->json(["status" => "success", "message" => "Password berhasil diubah."], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status" => "error", "message" => "Something Broken", "errormessage" => $e->getMessage()], 400);
        }
    }
}
