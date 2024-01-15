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
