<?php

namespace Mazecode\MusicPlayList\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mazecode\MusicPlayList\PlayList;

/**
 * Class TrackController
 * @package Mazecode\MusicPlayList\Controllers\Api
 */
class PlayListController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return (new PlayListCollection(PlayList::paginate()))->response()->setStatus(Response::HTTP_OK);
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
		$playlist = PlayList::create($input);

		return $this->sendResponse($playlist, 'PlayList created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Track  $track
	 * @return Response
	 */
	public function show(PlayList $playlist)
	{
		return $this->sendResponse($playlist, 'Track retrieved successfully.');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Track  $track
	 * @return Response
	 */
	public function update(Request $request, PlayList $playlist)
	{
		$input = $request->all();

		// if ($validator->fails()) {
		//     return $this->sendError('Validation Error.', $validator->errors());
		// }

		$playlist->update($input);

		return $this->sendResponse($playlist, 'playlist updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Track  $track
	 * @return Response
	 * @throws Exception
	 */
	public function destroy(PlayList $playlist)
	{ }
}
