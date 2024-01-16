<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/guest",
     *     @OA\Parameter(
    *          name="id",
    *          in="path",
    *          required=true,
    *          description="unauthorized page",
    *          @OA\Schema(type="integer")
    *      ),
    *
     *     @OA\Response(response="401", description="Not connected")
     *
     * )
     */
    public function index()
    {
        return response()->json([
            'message' => 'Not connected',
            'status' => '401'
        ]);
    }
}
