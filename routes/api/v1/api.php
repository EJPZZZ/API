<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\IncomeController;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return UserResource::make($request->user());
})->middleware('auth:sanctum')
	->name('api.v1.users.show');


Route::controller(BillController::class)
	->middleware('auth:sanctum')
	->group(function () {
		Route::get('/bills', 'index')->name('api.v1.bills.index');
		Route::get('/bills/{bill}', 'show')->name('api.v1.bills.show');
		Route::post('/bills', 'store')->name('api.v1.bills.create');
		Route::patch('/bills/{bill}', 'update')->name('api.v1.bills.update');
		Route::delete('/bills/{bill}', 'destroy')->name('api.v1.bills.destroy');
	});

Route::controller(IncomeController::class)
	->middleware('auth:sanctum')
	->group(function () {
		Route::get('/incomes', 'index')->name('api.v1.incomes.index');
		Route::get('/incomes/{income}', 'show')->name('api.v1.incomes.show');
		Route::post('/incomes', 'store')->name('api.v1.incomes.store');
		Route::patch('/incomes/{income}', 'update')->name('api.v1.incomes.update');
		Route::delete('/incomes/{income}', 'destroy')->name('api.v1.incomes.destoy');
	});

Route::controller(AuthenticationController::class)->group(function () {
	Route::post('/sanctum/login', 'login')->name('login');
	Route::post('/sanctum/register', 'register')->name('register');
	Route::post('/sanctum/logout', 'logout')->middleware('auth:sanctum')->name('logout');
});

Route::get('/check', function (Request $request) {
	return json_encode([
		'status' => true,
	]);
});
