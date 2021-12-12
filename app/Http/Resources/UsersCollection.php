<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    public $collects = 'App\Http\Resources\UserResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'data' => $this->collection,
            'links' => [
                'seft' => 'link-value'
            ],
            'other' => [
                'self2' => 'link-value2'
            ],
            'conditional_attribute' => $this->when(true, 'scret-value')
        ];
    }
}
