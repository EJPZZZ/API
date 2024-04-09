<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'type' => 'bill',
			'id' => (string) $this->resource->getRouteKey(),
			'attributes' => [
				'description' => $this->resource->description,
				'amount' => $this->resource->amount,
				'created_at' => $this->resource->created_at,
			],
			'links' => [
				'self' => route('api.v1.bills.show', $this->resource),
			]
		];
	}
}
