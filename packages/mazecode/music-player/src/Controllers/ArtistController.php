<?php

namespace Mazecode\MusicPlayer\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayer\Artist;
use Mazecode\MusicPlayer\Resources\ArtistResource;

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
        return ArtistResource::collection(Artist::all()->keyBy->id);

        // return $this->sendResponse(Artist::all()->toArray(), 'Artists retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $artist = Artist::create($input);

        return $this->sendResponse($artist->toArray(), 'Song created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist  $artist
     * @return Response
     */
    public function show(Artist $artist): Response
    {
        if (is_null($artist)) {
            return $this->sendError('Artist not found.');
        }

        return new ArtistResource($artist);

        // return $this->sendResponse($artist->toArray(), 'Artist retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Artist  $artist
     * @return Response
     */
    public function update(Request $request, Artist $artist): Response
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
    public function destroy(Artist $artist): Response
    {
        $artist->delete();

        return $this->sendResponse($artist->toArray(), 'Artist deleted successfully.');
    }
}
