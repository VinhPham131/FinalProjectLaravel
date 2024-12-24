<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @unauthenticated
     * @group Authentication
     * @bodyParam email string required The email of the user. Example: user@example.com
     * @bodyParam password string required The password of the user. Example: password
     * @response 200 {
     *   "success": "Login successfully"
     * }
     * @response 401 {
     *   "error": "Invalid credentials"
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // $user = Auth::user();
        // $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['success' => 'Login successfully'], 200);
    }
}
