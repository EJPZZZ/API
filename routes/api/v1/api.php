<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BillController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return UserResource::make($request->user());
})->middleware('auth:sanctum')
	->name('api.v1.users.show');

Route::post('/sanctum/token', [AuthenticationController::class, 'login']);

Route::post('/sanctum/logout', [AuthenticationController::class, 'logout'])
	->middleware('auth:sanctum');

Route::get('/bills', [BillController::class, 'index'])
	->name('api.v1.bills.index');

Route::get('/bills/{bill}', [BillController::class, 'show'])
	->name('api.v1.bills.show');

Route::post('/bills', [BillController::class, 'create'])
	->name('api.v1.bills.create');


Route::get('/check', function (Request $request) {
	return json_encode([
		'status' => true,
	]);
});
