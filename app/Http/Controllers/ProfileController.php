<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    
}
