<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Hero;

class TransportController extends Controller
{

    /**
     * @OA\Get(
     *     tags={"Display"},
     *     path="/api/transport",
     *     @OA\Response(response="200", description="Display all transport"),
     *     @OA\Response(response="405", description="Not connected")
     * )
     */

    public function index()
    {
        $users = Transport::all();

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
 *      path="/api/transport/create",
 *      summary="Create a transport",
 *      tags={"Creation"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Create a new transport",
 *          @OA\JsonContent(
 *              required={"name", "description","size"},
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="description", type="string", format="text"),
 *             @OA\Property(property="size", type="integer", format="int")
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
        $transport = Transport::create($request->all());
        return response()->json($transport, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/transport/{id}",
     *     tags={"Display"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the transport",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="200", description="Display a specific transport")
     * )
     */
    public function show(string $id)
    {
        $transport = Transport::find($id);
        return response()->json($transport);
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
 *      path="/api/transport/{id}/update",
 *      summary="update a transport",
 *      tags={"Modification"},
        * @OA\Parameter(
            *          name="id",
            *          in="path",
            *          required=true,
            *          description="ID of the transport",
            *          @OA\Schema(type="integer")
            *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          description="Update a transport",
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", format="text"),
 *              @OA\Property(property="description", type="string", format="text"),
 *              @OA\Property(property="size", type="integer", format="int")
 *
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Data successfully added",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="Data successfully updated"),
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
            'description' => 'sometimes',
            'size' => 'sometimes'
        ]);
        $transport = Transport::find($id);
        $transport->update($data);
        return response()->json($transport, 201);
    }


    /**
     * @OA\Delete(
     *     path="/api/transport/{id}/delete",
     *     tags={"Delete"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the transport",
     *          @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response="204", description="Data successfully deleted")
     * )
     */
    public function destroy(string $id)
    {
        $transport = Transport::find($id);
        $transport->delete();
        $hero = Hero::where('transport_way', $id);
        $hero->update(['transport_way' => 0]);
        return response()->json(null, 204);
    }
}
