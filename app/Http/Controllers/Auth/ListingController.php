<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function routes(Request $request)
    {
        return response()->json([
            'message' => 'Permission routes successfully.',
            'data' => Auth::user()->permissionRoutes()->toArray(),
        ], 200);
    }

    public function roles()
    {
        return response()->json([
            'message' => 'Roles successfully.',
            'data' => config('roles'),
        ], 200);
    }

    public function permissions()
    {
        return response()->json([
            'message' => 'Roles successfully.',
            'data' => config('permissions'),
        ], 200);
    }
}
