<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ListingController extends Controller
{
    public function routes()
    {
        $routesCollect = collect(Route::getRoutes());
        $routes = $routesCollect->filter(function ($value) {
            return $value->getName();
        });

        $routes = $routes->mapWithKeys(function ($item) {
            return [
                $item->getName() => [
                    'name' => $item->getName(),
                    'uri' => $item->uri(),
                    'method' => $item->methods[0],
                    'params' => $item->parameterNames(),
                    'permission' => false
                ]
            ];
        });

        if (Auth::check()) {
            foreach (Auth::user()->permissionRoutes() as $permission) {
                $routes = $routes->map(function ($item, $key) use ($permission) {
                    if ($permission === $item['name']) {
                        $item['permission'] = true;
                    }
                    return $item;
                });
            }
        }

        return response()->json([
            'message' => 'Routes successfully.',
            'data' => $routes,
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
