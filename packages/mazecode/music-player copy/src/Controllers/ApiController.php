<?php

namespace Mazecode\MusicPlayer\Controllers;

/**
 * Class AlbumController
 * @package Mazecode\MusicPlayer\Controllers\Api
 */
class ApiController extends BaseController
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
