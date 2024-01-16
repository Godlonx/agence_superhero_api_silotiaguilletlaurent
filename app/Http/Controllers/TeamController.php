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
 * @OA\Post(
 *      path="/api/team/create",
 *      summary="Create a team",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Create a new team",
 *          @OA\JsonContent(
 *              required={"name"},
 *              @OA\Property(property="name", type="string", format="text")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Data successfully added",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="Team successfully added"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="The given data was invalid."),
 *              @OA\Property(property="errors", type="object"),
 *          ),
 *      ),
 * )
 */
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required'
    ]);


    $team = new Team();
    $team->name = $data['name'];
    $team->save();

    return response()->json($team, 201);

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
