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

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/hero",
     *     @OA\Response(response="200", description="Display all heroes"),
     *     @OA\Response(response="405", description="Not connected")
     * )
     */
    public function index()
    {
        $hero = Hero::all();
        $hero=$hero->makeHidden(['updated_at', 'created_at']);
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
 *              required={"name","gender","hair_color","birth_planet","description","team_id","transport_way","city_id","power_id"},
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="gender", type="string", format="text"),
 *              @OA\Property(property="hair_color", type="string", format="text"),
 *              @OA\Property(property="birth_planet", type="string", format="text"),
 *              @OA\Property(property="team_id", type="integer", format="int"),
 *              @OA\Property(property="description", type="string", format="text"),
 *              @OA\Property(property="transport_way", type="integer", format="text"),
 *              @OA\Property(property="city_id", type="integer", format="int"),
 *              @OA\Property(property="power_id", type="integer", format="int")
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
            //'city_id' => 'required',
            'power_id' => 'required'
        ]);


        $hero = new Hero();
        $hero->name = $data['name'];
        $hero->gender = $data['gender'];
        $hero->hair_color = $data['hair_color'];
        $hero->birth_planet = $data['birth_planet'];
        $hero->description = $data['description'];
        $hero->team_id = $data['team_id'];
        $hero->transport_way = $data['transport_way'];

        $hero->save();

        $powerLink = new PowerLink();
        $powerLink->hero_id = $hero->id;
        $powerLink->power_id = $data['power_id'];
        $powerLink->save();
        //$hero->city()->attach($data['city_id']);


        return response()->json($hero, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/hero/{id}",
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

        $powerId = PowerLink::select('power_id')->where('hero_id', $id);
        $power = Power::find($powerId);

        $transportId = Hero::select('transport_way')->where('id', $id);
        $transport = Transport::find($transportId);

        $cityId = CityLink::select('city_id')->where('hero_id', $id);
        $city = City::find($cityId);


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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
