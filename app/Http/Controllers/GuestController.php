<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Not connected',
            'status' => '401'
        ]);
    }
}
