<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Power;

class PowerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/power",
     *     @OA\Response(response="200", description="Display all powers")
     * )
     */
    public function index()
    {
        $users = Power::all();

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
     *     path="/api/power/{id}",
     *     @OA\Parameter(
    *          name="id",
    *          in="path",
    *          required=true,
    *          description="ID of the city",
    *          @OA\Schema(type="integer")
    *      ),
     *     @OA\Response(response="200", description="Display a specific power")
     *
     * )
     */
    public function show(string $id)
    {
        $power = Power::find($id);
        return response()->json($power);
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
