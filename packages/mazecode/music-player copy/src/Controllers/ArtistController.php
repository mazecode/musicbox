<?php

namespace Mazecode\MusicPlayer\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayer\Models\Artist;
use Mazecode\MusicPlayer\Resources\ArtistCollection;
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
        return (new ArtistCollection(Artist::paginate()))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required'
        ]);

        $artist = Artist::create($input);

        return (new ArtistResource($artist))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist  $artist
     * @return Response
     */
    public function show(Artist $artist)
    {
        return (new ArtistResource($artist))->response()->setStatus(Response::HTTP_OK);
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
        $input = $request->validation([
            'name' => 'required',
        ]);

        $artist->update($input);

        return (new ArtistResource($artist))->response()->setStatusCode(Response::HTTP_NO_CONTENT);
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

        return response()->json([], Response::HTTP_NO_CONTENTS);
    }
}
