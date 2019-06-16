<?php

namespace Mazecode\MusicPlayer\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    private $response = [
        'data' => null,
        'error' => false,
        'messages' => [],
        'paginat',
    ];

    /**
     * success response method.
     *
     * @return Response
     */
    public function sendResponse(array $data, $message)
    {
        $response = [
            'data' => $data,
            'success' => true,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
