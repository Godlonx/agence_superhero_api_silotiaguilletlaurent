<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
/**
 * @OA\Post(
 *      path="/api/register",
 *      operationId="registerUser",
 *      summary="Register a new user",
 *      tags={"Authentication"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="User registration data",
 *          @OA\JsonContent(
 *              required={"name", "email", "password","_token"},
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="email", type="string", format="email"),
 *              @OA\Property(property="password", type="string", format="password"),
 *              @OA\Property(property="password_confirmation", type="string", format="password"),
 *              @OA\Property(property="_token", type="string"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="User successfully registered",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="User registered successfully"),
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
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
