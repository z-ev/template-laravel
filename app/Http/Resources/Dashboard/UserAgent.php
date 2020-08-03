<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\User as UserResource;
use App\Http\Resources\Dashboard\Token as TokenResource;

class UserAgent extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $input = $request->all();
        $input['user'] = new UserResource($this->user);
        $input['token'] = new TokenResource($this->token);
        return parent::toArray($input);
    }
}
