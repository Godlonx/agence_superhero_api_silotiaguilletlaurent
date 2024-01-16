<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;

class TransportController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/transport",
     *     @OA\Response(response="200", description="Display all transport"),
     *     @OA\Response(response="405", description="Not connected")
     * )
     */

    public function index()
    {
        $users = Transport::all();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/transport/{id}",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the transport",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="200", description="Display a specific transport")
     * )
     */
    public function show(string $id)
    {
        $transport = Transport::find($id);
        return response()->json($transport);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
