<?php

namespace Mazecode\MusicPlayer\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayer\Resources\ArtistResource;
use Mazecode\MusicPlayer\Models\Artist;
use Mazecode\MusicPlayer\Resources\ArtistCollection;

/**
 * Class ArtistController
 * @package Mazecode\MusicPlayer\Controllers\Api
 */
class ArtistController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return ArtistResourceç
     */
    public function index()
    {
        return new ArtistCollection(Artist::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $artist = Artist::create($input);

        return new ArtistResource($artist);
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist  $artist
     * @return Response
     */
    public function show(Artist $artist)
    {
        return new ArtistResource($artist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Artist  $artist
     * @return Response
     */
    public function update(Request $request, Artist $artist)
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $artist->name = $input['name'];
        $artist->detail = $input['detail'];
        $artist->save();

        return $this->sendResponse($artist->toArray(), 'Artist updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Artist  $artist
     * @return Response
     * @throws Exception
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return $this->sendResponse($artist->toArray(), 'Artist deleted successfully.');
    }
}
