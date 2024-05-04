<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillCollection;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
	public function index(): BillCollection
	{
		return BillCollection::make(Bill::all());
	}

	public function store(Request $request): BillResource
	{
		// return json_encode(auth('sanctum')->user());
		$bill = Bill::create([
			'user_id' => auth('sanctum')->user()['id'],
			'description' => $request->input('data.attributes.description'),
			'amount' => $request->input('data.attributes.amount'),
		]);

		return BillResource::make($bill);
	}

	public function show(Bill $bill): BillResource
	{
		return BillResource::make($bill);
	}


	public function update(Bill $bill, Request $request): BillResource
	{
		$bill->update($request->input('data.attributes'));
		return BillResource::make($bill);
	}

	public function destroy(Bill $bill): string
	{
		$bill->delete();
		return response('', 204);
	}
}
