<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityLink;

class CityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = CityLink::all();

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
 *      path="/api/cityLink/create",
 *      summary="Link a city to a hero",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Link a city to a hero",
 *          @OA\JsonContent(
 *              required={"hero_id", "city_id"},
 *              @OA\Property(property="hero_id", type="integer", example="1"),
 *              @OA\Property(property="city_id", type="integer", example="1"),
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
        $cityLink = new CityLink();
        $cityLink->hero_id = $request->hero_id;
        $cityLink->city_id = $request->city_id;
        $cityLink->save();

        return response()->json([
            'message' => 'Data successfully added',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cityLink = CityLink::find($id);
        return response()->json($cityLink);
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
 *      path="/api/cityLink/delete",
 *      summary="Delete a link beetween a city and a hero",
 *      tags={"Delete"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Delete a link beetween a city and a hero",
 *          @OA\JsonContent(
 *              required={"hero_id", "city_id"},
 *              @OA\Property(property="hero_id", type="integer", example="1"),
 *              @OA\Property(property="city_id", type="integer", example="1"),
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
        $cityLink = CityLink::where('hero_id', $request->hero_id)->where('city_id', $request->city_id);
        if ($cityLink == null) {
            return response()->json([
                'message' => 'Data not found',
            ], 404);
        }
        $cityLink->delete();

        return response()->json([
            'message' => 'Data successfully deleted',
        ], 201);
    }
}
