<?php

namespace Mazecode\MusicPlayList\Resources;

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
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('artists.show', ['id' => $this->id]),
            ],

        ];
    }
}
