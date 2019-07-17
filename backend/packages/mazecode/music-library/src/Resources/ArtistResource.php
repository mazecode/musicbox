<?php

namespace Mazecode\MusicLibrary\Resources;

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
            'id' => (string) $this->id,
            'type' => $this->is_music_band ? 'music_band' : 'artist',
            'attributes' => [
                'name' => $this->name,
                'birthday' => $this->when(!$this->is_music_band && !is_null($this->birhtday), function () {
                    return $this->birthday;
                }),
                'music_band' => $this->when(!$this->is_music_band, function () {
                    return new BandResource($this->band);
                }),
                'members' => $this->when($this->is_music_band, function () {
                    return ArtistResource::collection($this->members);
                }),
            ],
            'links' => [
                'self' => route('artists.show', ['id' => $this->id]),
            ],

        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
