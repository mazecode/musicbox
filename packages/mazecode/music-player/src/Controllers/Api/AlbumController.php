<?php

namespace Mazecode\MusicPlayer\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayer\Album;
use Mazecode\MusicPlayer\Controllers\BaseController;

/**
 * Class AlbumController
 * @package Mazecode\MusicPlayer\Controllers\Api
 */
class AlbumController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->sendResponse(Album::all()->toArray(), 'Albums retrieved successfully.');
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

        $album = Album::create($input);

        return $this->sendResponse($album->toArray(), 'Album created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Album  $album
     * @return Response
     */
    public function show(Album $album): Response
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
     * @return Response
     */
    public function update(Request $request, Album $album): Response
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
     * @return Response
     * @throws Exception
     */
    public function destroy(Album $album): Response
    {
        $album->delete();

        return $this->sendResponse($album->toArray(), 'Album deleted successfully.');
    }
}
