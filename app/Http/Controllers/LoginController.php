<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function login(Request $request): string
	{
		$request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
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

	public function logout(): string
	{
		return json_encode([Auth::user()]);
	}
}
