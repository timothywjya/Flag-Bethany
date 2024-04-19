<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Helper\HashingIds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function getDataUser()
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
                    "users.deleted_at"
                );

            if (Auth::user()->role_id == 2) {
                $users = $users->whereIn('role_id', [2, 3, 4, 5]);
            }

            $users = $users->get();

            foreach ($users as $user) {
                $user->id = HashingIds::encodeUser($user->id);
            }

            return response()->json(["status" => "success", "data" => $users, "message" => "Get Data Successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["status" => "error", "message" => "Failed to Get Data Successfully", "errormessage" => $e->getMessage()], 400);
        }
    }

    public function getDataRole()
    {
        try {
            $role = DB::table("roles")
                ->select("id", "role_name");

            if (in_array(Auth::user()->role_id, [3, 4])) {
                $role = $role->whereNotIn('id', [1, 2, 3, 4]);
            }

            if (Auth::user()->role_id == 2) {
                $role = $role->whereNotIn('id', [1, 2, 5, 6, 7, 8, 9, 10]);
            }

            if (Auth::user()->role_id == 1) {
                $role = $role->whereNotIn('id', [5, 6, 7, 8, 9, 10]);
            }

            $role = $role->get();

            foreach ($role as $roles) {
                $roles->id = HashingIds::encodeRole($roles->id);
            }

            return response()->json(["status" => "success", "data" => $role, "message" => "Get Data Successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["status" => "error", "message" => "Failed to Get Data Successfully", "errormessage" => $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            if (HashingIds::decodeUser($request->ids) == Auth::user()->id) {
                return response()->json(["status" => "error", "message" => "Anda tidak dapat menghapus diri sendiri"], 400);
            }

            User::where('id', HashingIds::decodeUser($request->ids))
                ->delete();

            DB::commit();

            return response()->json(["status" => "success", "message" => "Delete User Successfully"], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["status" => "error", "message" => "Failed to Delete User", "errormessage" => $e->getMessage()], 400);
        }
    }
}
