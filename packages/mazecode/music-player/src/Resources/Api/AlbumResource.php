<?php

namespace Mazecode\MusicPlayer\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return parent::toArray($request);

        return [
            'type' => 'articles',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
            ],
            // 'relationships' => new ArticlesRelationshipResource($this),
            'links' => [
                'self' => route('albums.show', ['article' => $this->id]),
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
