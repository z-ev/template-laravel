<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
            'headers' => [
                ['text' => '#', 'align' => 'left', 'value' => 'id'],
                ['text' => 'Имя', 'align' => 'center', 'value' => 'name'],
                ['text' => 'E-mail', 'align' => 'left', 'value' => 'email'],
                ['text' => 'Действия', 'align' => 'right', 'value' => 'action', 'sortable' => false],
            ]
        ];
    }
}
