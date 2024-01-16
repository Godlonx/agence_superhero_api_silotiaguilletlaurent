<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{
    /**
 * @OA\Post(
 *      path="/api/login",
 *      operationId="loginUser",
 *      summary="Log an user",
 *      tags={"Authentication"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="User registration data",
 *          @OA\JsonContent(
 *              required={"email", "password","_token"},
 *              @OA\Property(property="email", type="string", format="email"),
 *              @OA\Property(property="password", type="string", format="password")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="User successfully logged",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="message", type="string", example="User logged successfully"),
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

    public function store(Request $request): JsonResponse
    {
        // Validate user credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Authenticate the user based on the provided credentials
        if (Auth::attempt($credentials)) {
            // Get the authenticated user
            $user = Auth::user();

            // Generate a token for the authenticated user
            $token = $user->createToken('auth-token')->plainTextToken;

            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Return the token in the response
            return response()->json(['token' => $token], 201);
        }

        // Return an error response if authentication fails
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
