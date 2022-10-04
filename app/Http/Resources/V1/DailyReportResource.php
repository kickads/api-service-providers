<?php

namespace App\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param Request $request
	 * @return array
	 */
	public function toArray($request): array
	{
		return [
			'id'                 => $this->id,
			'provider_id'        => $this->provider_id,
			'imp'                => $this->imp,
			'imp_adv'            => $this->imp_adv,
			'imp_branding'       => $this->imp_branding,
			'clics'              => $this->clics,
			'clics_adv'          => $this->clics_adv,
			'spend'              => $this->spend,
			'revenue'            => $this->revenue,
			'date'               => $this->date,
			'profit'             => $this->profit,
			'click_through_rate' => $this->click_through_rate,
			'eCPM'               => $this->eCPM,
			'eCPC'               => $this->eCPC,
			'eCPA'               => $this->eCPA,
		];
	}
}
