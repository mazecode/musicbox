<?php

namespace Mazecode\MusicLibrary\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicLibrary\Models\Album;

/**
 * Class AlbumController
 * @package Mazecode\MusicLibrary\Controllers\Api
 */
class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return $this->sendResponse(Album::all()->toArray(), 'Albums retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $album = Album::create($input);

        return $this->sendResponse($album->toArray(), 'Album created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Album  $album
     */
    public function show(Album $album)
    {
        if (is_null($album)) {
            return $this->sendError('Album not found.');
        }

        return $this->sendResponse($album->toArray(), 'Album retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Album  $album
     */
    public function update(Request $request, Album $album)
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $album->name = $input['name'];
        $album->detail = $input['detail'];
        $album->save();

        return $this->sendResponse($album->toArray(), 'Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Album  $album
     * @throws Exception
     */
    public function destroy(Album $album)
    {
        $album->delete();

        return $this->sendResponse($album->toArray(), 'Album deleted successfully.');
    }
}
