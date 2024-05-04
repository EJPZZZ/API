<?php

namespace App\Http\Controllers;

use App\Http\Resources\IncomeCollection;
use App\Http\Resources\IncomeResource;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
	public function index(): IncomeCollection
	{
		return IncomeCollection::make(Income::all());
	}

	public function store(Request $request): IncomeResource
	{
		$income = Income::create([
			'user_id' => auth('sanctum')->user()['id'],
			'description' => $request->input('data.attributes.description'),
			'amount' => $request->input('data.attributes.amount'),
		]);

		return IncomeResource::make($income);
	}

	public function show(Income $income): IncomeResource
	{
		return IncomeResource::make($income);
	}

	public function update(Income $income, Request $request): IncomeResource
	{
		$income->update($request->input('data.attributes'));
		return IncomeResource::make($income);
	}

	public function destroy(Income $income): string
	{
		$income->delete();
		return response('', 204);
	}
}
