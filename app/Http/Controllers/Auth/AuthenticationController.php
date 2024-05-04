<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
	public function register(Request $request): JsonResponse
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['email', 'unique:users,email', 'max:255'],
			'password' => ['required', 'min:6', 'confirmed'],
			'device_name' => ['required', 'string', 'max:255'],
		]);


		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password
		]);

		return response()->json([
			'message' => 'Usuario registrado con éxito',
			'access_token' => $user->createToken($request->device_name)->plainTextToken,
			'token_type' => 'Bearer',
		]);
	}

	public function login(Request $request): string
	{
		$request->validate([
			'email' => ['required', 'email', 'max:255'],
			'password' => ['required', 'min:6'],
			'device_name' => ['required'],
		]);

		$user = User::where('email', $request->email)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}

		return $user->createToken($request->device_name)->plainTextToken;
	}

	public function logout(Request $request): string
	{
		$request->user()->currentAccessToken()->delete();
		return json_encode([]);
	}
}
