<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\PowerLink;
use App\Models\Power;
use App\Models\CityLink;
use App\Models\City;
use App\Models\Team;
use App\Models\Transport;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/hero",
     *     tags={"Display"},
     *     @OA\Response(response="200", description="Display all heroes"),
     *     @OA\Response(response="405", description="Not connected")
     * )
     */
    public function index()
    {
        $hero = Hero::all();
        return response()->json($hero);
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
 *      path="/api/hero/create",
 *      summary="Create a hero",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Create a new hero",
 *          @OA\JsonContent(
 *              required={"name","gender","hair_color","birth_planet","description","team_id","transport_way"},
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="gender", type="string", format="text"),
 *              @OA\Property(property="hair_color", type="string", format="text"),
 *              @OA\Property(property="birth_planet", type="string", format="text"),
 *              @OA\Property(property="team_id", type="integer", format="int"),
 *              @OA\Property(property="description", type="string", format="text"),
 *              @OA\Property(property="transport_way", type="integer", format="text"),
 *
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
            'gender' => 'required',
            'hair_color' => 'required',
            'birth_planet' => 'required',
            'description' => 'required',
            'team_id' => 'required',
            'transport_way' => 'required',
        ]);


        $hero = new Hero();
        $hero->name = $request->name;
        $hero->gender = $request->gender;
        $hero->hair_color = $request->hair_color;
        $hero->birth_planet = $request->birth_planet;
        $hero->description = $request->description;
        $hero->team_id = $request->team_id;
        $hero->transport_way = $request->transport_way;
        $hero->save();



        return response()->json($hero, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/hero/{id}",
     *     tags={"Display"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the hero",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="200", description="Display a specific hero and his power, transport, city, and team")
     * )
     */
    public function show(string $id,Request $request)
    {

        $hero = Hero::find($id);

        $powerId = PowerLink::select('power_id')->where('hero_id', $id)->get();
        $power = Power::whereIn('id', $powerId)->get();


        $transportId = Hero::select('transport_way')->where('id', $id);
        $transport = Transport::find($transportId);

        $cityId = CityLink::select('city_id')->where('hero_id', $id)->get();
        $city = City::whereIn('id', $cityId)->get();


        $teamId = Hero::select('team_id')->where('id', $id);
        $team = Team::find($teamId);


        return response()->json(array(
            'hero' => $hero,
            'power' => $power,
            'transport' => $transport,
            'city' => $city,
            'team' => $team
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
 *      path="/api/hero/{id}/update",
 *      summary="update a hero",
 *      tags={"Modification"},
        * @OA\Parameter(
            *          name="id",
            *          in="path",
            *          required=true,
            *          description="ID of the hero",
            *          @OA\Schema(type="integer")
            *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          description="Update a hero",
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="gender", type="string", format="text"),
 *              @OA\Property(property="hair_color", type="string", format="text"),
 *              @OA\Property(property="birth_planet", type="string", format="text"),
 *              @OA\Property(property="team_id", type="integer", format="int"),
 *              @OA\Property(property="description", type="string", format="text"),
 *              @OA\Property(property="transport_way", type="integer", format="text")
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
            'name' => 'sometimes',
            'gender' => 'sometimes',
            'hair_color' => 'sometimes',
            'birth_planet' => 'sometimes',
            'description' => 'sometimes',
            'team_id' => 'sometimes',
            'transport_way' => 'sometimes',
        ]);

        $hero = Hero::find($id);
        $hero->update($data);

    }

    /**
     * @OA\Delete(
     *     path="/api/hero/{id}/delete",
     *     tags={"Delete"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the hero",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="204", description="Data successfully deleted")
     * )
     */
    public function destroy(string $id)
    {
        $hero = Hero::find($id);
        $hero->delete();
        $powerLink = PowerLink::where('hero_id', $id);
        $powerLink->delete();
        return response()->json(null, 204);
    }


}
