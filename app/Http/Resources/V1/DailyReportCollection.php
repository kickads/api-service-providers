<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class DailyReportCollection extends ResourceCollection
{
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param Request $request
	 * @return Collection
	 */
	public function toArray($request): Collection
	{
		return $this->collection;
	}
	
	/**
	 * Return an array of data to be made available to the view.
	 *
	 * @param request $request The incoming request.
	 *
	 * @return array The status of the request.
	 */
	public function with($request): array
	{
		return [
			'status' => 'success'
		];
	}
}
