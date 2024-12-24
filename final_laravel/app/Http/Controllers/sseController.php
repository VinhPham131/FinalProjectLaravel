<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;

final class sseController extends Controller
{

    public function index()
    {
        // Create a response object
        $response = new StreamedResponse(function () {
            $data = json_encode(['message' => 'This is a message']);

            echo "data: $data\n\n";

            // Flush the output buffer
            ob_flush();
            flush();
        });

        // Set the right headers for SSE.
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }

}
