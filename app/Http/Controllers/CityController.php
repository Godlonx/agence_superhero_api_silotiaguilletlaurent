<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CityLink;
use App\Models\Hero;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/city",
     *     @OA\Response(response="200", description="Display all cities")
     * )
     */
    public function index()
    {
        $users = City::all();

        return response()->json($users);
    }


    public function create()
    {
        //
    }

 /**
 * @OA\Post(
 *      path="/api/city/create",
 *      summary="Create a city",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Create a new city",
 *          @OA\JsonContent(
 *              required={"name", "description","size"},
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="description", type="string", format="text"),
 *              @OA\Property(property="size", type="integer", format="text")
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
            'size' => 'required'
        ]);

        $city = new City();
        $city->name = $data['name'];
        $city->description = $data['description'];
        $city->size = $data['size'];
        $city->save();

        return response()->json($city, 201);

    }

    /**
     * @OA\Get(
     *     path="/api/city/{id}",
     *     @OA\Parameter(
    *          name="id",
    *          in="path",
    *          required=true,
    *          description="ID of the city",
    *          @OA\Schema(type="integer")
    *      ),
     *     @OA\Response(response="200", description="Display a specific city and its heroes")
     *
     * )
     */
    public function show(string $id)
    {
        $city = City::find($id);

        $heroId = CityLink::select('hero_id')->where('city_id', $id)->get();

        $hero = Hero::whereIn('id', $heroId)->get();

        return response()->json(array(
            'city' => $city,
            'hero' => $hero
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idHero, string $idCity)
    {
        //
    }

   /**
 * @OA\Put(
 *      path="/api/city/{id}/update",
 *      summary="update a city",
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
 *          description="Update a city",
 *          @OA\JsonContent(
 *                  @OA\Property(property="name", type="string", format="text"),
 *                  @OA\Property(property="description", type="string", format="text"),
 *                  @OA\Property(property="size", type="integer", format="text")
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
            'name' => 'required',
            'description' => 'required',
            'size' => 'required'
        ]);

        $city = City::find($id);
        $city->update($data);

        return response()->json($city, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/city/{id}/delete",
     *     tags={"Delete"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the city",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="204", description="Data successfully deleted")
     * )
     */
    public function destroy(string $id)
    {
        $city = City::find($id);
        $city->delete();
        $cityLink = CityLink::where('city_id', $id);
        $cityLink->delete();
        return response()->json(null, 204);
    }
}
