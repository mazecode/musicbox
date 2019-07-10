<?php

namespace Mazecode\MusicLibrary\Controllers;

/**
 * Class AlbumController
 * @package Mazecode\MusicLibrary\Controllers\Api
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
