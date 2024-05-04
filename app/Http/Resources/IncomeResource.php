<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'type' => 'income',
			'id' => (string) $this->resource->getRouteKey(),
			'attributes' => [
				'description' => $this->resource->description,
				'amount' => $this->resource->amount,
				'created_at' => $this->resource->created_at,
			],
			'links' => [
				'self' => route('api.v1.incomes.show', $this->resource),
			]
		];
	}
}
