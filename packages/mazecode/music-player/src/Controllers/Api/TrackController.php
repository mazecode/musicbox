<?php

namespace Mazecode\MusicPlayer\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayer\Controllers\BaseController;
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
    public function index(): Response
    {
        return $this->sendResponse(Track::all()->toArray(), 'Tracks retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) return $this->sendError('Validation Error.', $validator->errors());

        $track = Track::create($input);

        return $this->sendResponse($track->toArray(), 'Track created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Track $track
     * @return Response
     */
    public function show(Track $track): Response
    {
        if (is_null($track)) return $this->sendError('Track not found.');

        return $this->sendResponse($track->toArray(), 'Track retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Track $track
     * @return Response
     */
    public function update(Request $request, Track $track): Response
    {
        $input = $request->all();

        $validator = Validator::make($input, []);

        if ($validator->fails()) return $this->sendError('Validation Error.', $validator->errors());

        $track->name = $input['name'];
        $track->detail = $input['detail'];
        $track->save();

        return $this->sendResponse($track->toArray(), 'Track updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Track $track
     * @return Response
     * @throws \Exception
     */
    public function destroy(Track $track): Response
    {
        $track->delete();

        return $this->sendResponse($track->toArray(), 'Track deleted successfully.');
    }
}
