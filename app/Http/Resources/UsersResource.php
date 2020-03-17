<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            "id"  => $this->id,
            "name"  => $this->name,
            "username"  => $this->username,
            "email"  => $this->email,
            "national_id"  => $this->national_id,
            "age"  => $this->age,
            "sex"  => $this->sex,
            "address"  => $this->address,
            "phone"  => $this->phone,
            "phone2"  => $this->phone2,
            "diagnosis"  => $this->diagnosis,
            "serial_number"  => $this->serial_number,
            "buy"  => $this->buy,
            "governorate"  => GovernorateResource::make($this->governorate),
            "created_at"  => $this->created_at->format('d/m/Y h:i A'),
        ];

        return $data;
    }
}
