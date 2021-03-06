<?php

namespace Mazecode\MusicLibrary\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BandResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = false;

    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'band',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'members' => ArtistResource::collection($this->whenLoaded('members')),
            ],
            'links' => [
                'self' => route('artists.show', ['id' => $this->id]),
            ],

        ];
    }
}
