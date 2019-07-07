<?php

namespace Mazecode\MusicPlayer\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayer\Track;

/**
 * Class TrackController
 * @package Mazecode\MusicPlayer\Controllers\Api
 */
class TrackController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new TrackCollection(Track::paginate()))->response()->setStatus(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([]);
        $track = Track::create($input);

        return $this->sendResponse($track, 'Track created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Track  $track
     * @return Response
     */
    public function show(Track $track)
    {
        return $this->sendResponse($track->toArray(), 'Track retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Track  $track
     * @return Response
     */
    public function update(Request $request, Track $track)
    {
        $input = $request->all();

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }

        $track->name = $input['name'];
        $track->detail = $input['detail'];
        $track->save();

        return $this->sendResponse($track->toArray(), 'Track updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Track  $track
     * @return Response
     * @throws Exception
     */
    public function destroy(Track $track)
    {
    }
}
