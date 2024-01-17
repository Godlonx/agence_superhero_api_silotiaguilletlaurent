<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Power;
use App\Models\PowerLink;

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
 * @OA\Post(
 *      path="/api/power/create",
 *      summary="Create a power",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Create a new power",
 *          @OA\JsonContent(
 *              required={"name", "description"},
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="description", type="string", format="text")
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);


        $power = new Power();
        $power->name = $data['name'];
        $power->description = $data['description'];
        $power->save();

        return response()->json($power, 201);

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
     * @OA\Delete(
     *     path="/api/power/{id}/delete",
     *     tags={"Delete"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the power",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="204", description="Data successfully deleted")
     * )
     */
    public function destroy(string $id)
    {
        $power = Power::find($id);
        $power->delete();
        $powerLink = PowerLink::where('power_id', $id);
        $powerLink->delete();
        return response()->json(null, 204);
    }
}
