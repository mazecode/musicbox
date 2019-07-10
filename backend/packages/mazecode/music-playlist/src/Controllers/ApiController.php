<?php

namespace Mazecode\MusicPlayList\Controllers;

/**
 * Class AlbumController
 * @package Mazecode\MusicPlayList\Controllers\Api
 */
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JSON
     */
    public function index()
    {
        return $this->sendResponse([], 'Welcome to Music Player API');
    }

}
