<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'paid_num' => $this->paid_num,
            'free_num' => $this->free_num,
            'orders' => $this->orders()->count(),
            'paid' => $this->orders()->where('has_free',0)->count(),
            'free' => $this->orders()->where('has_free',1)->count(),
            'patients' => count($this->orders->unique('patient_id')),
            'male' => count($this->orders()->whereHas('patient',function ($patient){
                $patient->where('sex',1);
            })->get()->unique('patient_id')),
            'female' => count($this->orders()->whereHas('patient',function ($patient){
                $patient->where('sex',2);
            })->get()->unique('patient_id')),
            'Pharmacies' => count($this->orders->unique('pharmacy_id')),
            'photo' => $this->photo,
        ];
    }
}
