<?php

namespace App\Http\Controllers;

use App\Helper\HashingIds;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function ApiLogin(Request $request)
    {
        try {
            $users = DB::table('users')
                ->join("roles", "roles.id", "=", "users.role_id")
                ->select(
                    "users.name as name",
                    "users.email as email",
                    "users.id",
                    "users.role_id",
                    "users.email as email",
                    "users.username as username",
                    "roles.role_name as roles",
                    "users.deleted_at",
                    "users.password"
                )->whereNull("users.deleted_at")
                ->where("users.username", $request->username)
                ->get();

            foreach ($users as $user) {
                $user->id = HashingIds::encodeUser($user->id);
                $user->role_id = HashingIds::encodeRole($user->role_id);
            }

            if (!Hash::check($request->password, $users->password)) {
                return response()->json(["status" => "error", "message" => "Password lama yang anda masukan salah"], 400);
            }

            if ($users->count() > 0) {
                session([
                    "login" => true,
                    "userid" => $users->username,
                    "userlevel" => $users->role_id,
                    "levelname" => $users->roles,
                ]);
            }

            return response()->json([
                "status" => "success",
                "user_login" => session("User_Login")
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Akun anda tidak terdaftar. Silahkan Hubungi Admin",
                "errormessage" => $e->getMessage()
            ], 400);
        }
    }

    public function ApiLogout()
    {
        session()->flush();
        return redirect("/login");
    }
}
