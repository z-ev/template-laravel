<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\UserAgent;
use Illuminate\Http\Request;
use App\Http\Resources\Dashboard\UserAgent as UserAgentResource;
use App\Http\Resources\Dashboard\UserAgentCollection;
use Illuminate\Support\Facades\Auth;

class UserAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserAgentCollection(UserAgent::where('user_id', Auth::id())->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAgent  $userAgent
     * @return \Illuminate\Http\Response
     */
    public function show(UserAgent $userAgent)
    {
        return new UserAgentResource($userAgent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAgent  $userAgent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAgent $userAgent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAgent  $userAgent
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAgent $userAgent)
    {
        $userAgent->delete();

        return;
    }
}
