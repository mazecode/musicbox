<?php

namespace Mazecode\MusicPlayList\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'track',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
            ],
            'links' => [
                'self' => route('tracks.show', ['id' => $this->id]),
            ],

        ];
    }
}
