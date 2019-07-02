<?php

namespace Mazecode\MusicPlayer\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\Resource;

class AlbumResource extends Resource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'type' => 'albums',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'published' => $this->published,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('albums.show', ['id' => $this->id]),
            ],
        ];

    }

    /**
     * @param  Request  $request
     * @return array
     */
    public function with(Request $request)
    {
        return [
            'links' => [
                'self' => route('albums.index'),
            ],
        ];
    }
}
