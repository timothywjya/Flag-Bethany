<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
                return response()->json([
                    "status" => "error",
                    "message" => "Your Password is Incorrect"
                ], 400);
            }

            DB::beginTransaction();

            DB::table("users")
                ->where("id", Auth::user()->id)
                ->update(["password" => bcrypt($request->password)]);

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Password has been Changed"
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => "error",
                "message" => "Something Broken",
                "errormessage" => $e->getMessage()
            ], 400);
        }
    }

    public function verificationPassword(Request $request)
    {
        try {
            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    "status" => "error",
                    "message" => "Your Password is Incorrect"
                ], 400);
            }

            return response()->json([
                "status" => "success",
                "message" => "Your Password is Correct"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Your Password Confirmation is Wrong",
                "errormessage" => $e->getMessage()
            ], 400);
        }
    }

    public function DisableUser(Request $request)
    {
        try {
            User::where("id", Auth::user()->id)
                ->delete();

            return response()->json(["status" => "success", "message" => "Sorry, But We Banned your Account"]);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Your Password Confirmation is Wrong",
                "errormessage" => $e->getMessage()
            ], 400);
        }
    }
}
