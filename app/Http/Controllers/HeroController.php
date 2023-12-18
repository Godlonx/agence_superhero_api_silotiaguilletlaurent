<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\PowerLink;
use App\Models\Power;
use App\Models\CityLink;
use App\Models\City;
use App\Models\Team;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = Hero::all();
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hero = Hero::find($id);

        $powerId = PowerLink::select('power_id')->where('hero_id', $id);
        $power = Power::find($powerId);

        $cityId = CityLink::select('city_id')->where('hero_id', $id);
        $city = city::find($cityId);

        $teamId = Hero::select('team_id')->where('hero_id', $id);
        $team = Team::find($teamId);

        return response()->json(array(
            'hero' => $hero,
            'power' => $power,
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
