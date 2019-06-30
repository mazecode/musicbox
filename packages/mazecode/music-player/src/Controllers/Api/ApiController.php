<?php

namespace Mazecode\MusicPlayer\Controllers\Api;

use Mazecode\MusicPlayer\Controllers\BaseController;

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
