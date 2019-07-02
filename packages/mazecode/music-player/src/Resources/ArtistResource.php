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
    public $preserveKeys = true;

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
                'band' => new ArtistResource($this->bands),
                'influences' => $this->influences,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('artists.show', ['id' => $this->id]),
            ],

        ];
    }
}
