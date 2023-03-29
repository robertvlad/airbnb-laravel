<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index(){
 
        if (Auth::check()) {
            $user = Auth::user();
        }

        return response()->json([
            'success' => true,
            'results' => $user,
        ]);
    }

}
