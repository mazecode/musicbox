<?php

namespace Mazecode\MusicPlayer\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
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
            'type' => 'artist',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'band' => $this->when($this->band, function() { 
                    return new BandResource($this->bands); 
                }),
                'members' => ArtistResource::collection($this->whenLoaded('members')),
                'influences' => ArtistResource::collection($this->whenLoaded('influences')),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('artists.show', ['id' => $this->id]),
            ],

        ];
    }
}
