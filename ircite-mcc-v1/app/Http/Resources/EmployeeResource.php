<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
                'id' => $this->id,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'position' => $this->position,
                'sickLeaveCredits' => $this->sickLeaveCredits,
                'vacationLeaveCredits' => $this->vacationLeaveCredits,
                'hourlyRate' => $this->hourlyRate
        ];
    }
}
