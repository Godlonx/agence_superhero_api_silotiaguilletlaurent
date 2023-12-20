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

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
