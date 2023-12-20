<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Hero;

class TeamController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/team",
     *     @OA\Response(response="200", description="Display all team")
     * )
     */
    public function index()
    {
        $users = Team::all();

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
     *     path="/api/team/{id}",
     *     @OA\Parameter(
    *          name="id",
    *          in="path",
    *          required=true,
    *          description="ID of the city",
    *          @OA\Schema(type="integer")
    *      ),
     *     @OA\Response(response="200", description="Display a specific team and its heroes")
     *
     * )
     */
    public function show(string $id)
    {
        $team = Team::find($id);
        $hero = Hero::where('team_id', $id)->get();
        return response()->json(array(
            'team' => $team,
            'hero' => $hero
        ));
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
