<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\UserAgentCollection;

class User extends JsonResource
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
        $input['userAgents'] = new UserAgentCollection($this->userAgents);
        return parent::toArray($request);
    }
}
