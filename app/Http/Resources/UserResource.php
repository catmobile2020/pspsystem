<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "specialty"  => $this->specialty,
            "preferred_distributor"  => $this->preferred_distributor,
            "doctor_code"  => $this->doctor_code,
            "buy"  => $this->buy,
            "governorate_id"  => $this->governorate,
            "call_center_id"  => $this->callCenter,
            "created_at"  => $this->created_at->format('d/m/Y h:i A'),
        ];
        if ($this->type == 1)
        {
            $data['doctor'] = UserResource::make($this->doctorRow);
        }
        return $data;
    }
}
