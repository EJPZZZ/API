<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomeCollection extends ResourceCollection
{
	public function toArray(Request $request): array
	{
		return [
			'data' => $this->collection,
			'links' => [
				'self' => route('api.v1.incomes.index')
			]
		];
	}
}
