<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        return view();
    }

    public function getDataMember()
    {
        try {
            $member = DB::table("members")
                ->join("users", "users.id", "=", "members.user_id")
                ->select("members.id, user_id", "full_name", "date_of_birth", "call_name")
                ->get();

            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json([], 400);
        }
    }
}
