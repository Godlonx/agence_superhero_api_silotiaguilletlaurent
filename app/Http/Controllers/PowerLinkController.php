<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PowerLink;

class PowerLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = PowerLink::all();

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
 *      path="/api/powerLink/create",
 *      summary="Link a power to a hero",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Link a power to a hero",
 *          @OA\JsonContent(
 *              required={"hero_id", "power_id"},
 *              @OA\Property(property="hero_id", type="integer", example="1"),
 *              @OA\Property(property="power_id", type="integer", example="1"),
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
        $powerLink = new PowerLink();
        $powerLink->hero_id = $request->hero_id;
        $powerLink->power_id = $request->power_id;
        $powerLink->save();

        return response()->json([
            'message' => 'Data successfully added',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $powerLink = PowerLink::find($id);
        return response()->json($powerLink);
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
 *      path="/api/powerLink/delete",
 *      summary="Delete a link beetween a power and a hero",
 *      tags={"Delete"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Delete a link beetween a power and a hero",
 *          @OA\JsonContent(
 *              required={"hero_id", "power_id"},
 *              @OA\Property(property="hero_id", type="integer", example="1"),
 *              @OA\Property(property="power_id", type="integer", example="1"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Data successfully deleted",
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
    public function destroy(request $request)
    {
        $data = $request->validate([
            'hero_id' => 'required',
            'power_id' => 'required',
        ]);

        $powerLink = PowerLink::where('hero_id', $data['hero_id'])
            ->where('power_id', $data['power_id']);

        if (!$powerLink) {
            return response()->json([
                'message' => 'Data not found',
            ], 404);
        }

        $powerLink->delete();

        return response()->json([
            'message' => 'Data successfully deleted',
        ], 201);
    }
}
