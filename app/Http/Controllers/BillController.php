<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillCollection;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
	public function index(): BillCollection
	{
		return BillCollection::make(Bill::all());
	}

	public function show(Bill $bill): BillResource
	{
		return BillResource::make($bill);
	}

	public function create(Request $request)
	{
		// return json_encode(auth('sanctum')->user());
		$bill = Bill::create([
			'user_id' => auth('sanctum')->user()['id'],
			'description' => $request->input('data.attributes.description'),
			'amount' => $request->input('data.attributes.amount'),
		]);

		return BillResource::make($bill);
	}
}
