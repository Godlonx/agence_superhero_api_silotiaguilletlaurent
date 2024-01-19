<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Hero;

class TeamController extends Controller
{
        /**
     * @OA\Get(
     *     tags={"Display"},
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
     *     tags={"Display"},
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
 * @OA\Put(
 *      path="/api/team/{id}/update",
 *      summary="update a team",
 *      tags={"Modification"},
        * @OA\Parameter(
            *          name="id",
            *          in="path",
            *          required=true,
            *          description="ID of the team",
            *          @OA\Schema(type="integer")
            *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          description="Update a hero",
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", format="text")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Data successfully added",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="Data successfully added"),
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
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'sometimes'
        ]);

        $team = Team::find($id);
        $team->update($data);
    }

    /**
     * @OA\Delete(
     *     path="/api/team/{id}/delete",
     *     tags={"Delete"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the team",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="204", description="Data successfully deleted")
     * )
     */
    public function destroy(string $id)
    {
        $team = Team::find($id);
        $team->delete();
        $hero = Hero::where('team_id', $id)->get();
        foreach ($hero as $h) {
            $h->team_id = 1;
            $h->save();
        }

        return response()->json(null, 204);
    }
}
