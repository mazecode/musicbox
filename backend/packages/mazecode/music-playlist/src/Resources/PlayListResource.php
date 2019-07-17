<?php

namespace Mazecode\MusicPlayList\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\Resource;

class PlayListResource extends Resource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'type' => 'playlist',
            'id' => (int) $this->id,
            'attributes' => [
                'user' => (int) $this->user_id,
                'name' => $this->name,
                'tracks' => $this->tracks,
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
