<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
              "id"  => $this->id,
              "serial_number"  => $this->serial_number,
              "comment"  => $this->comment,
              "has_free"  => (boolean) $this->has_free,
              "confirmation_code"  => $this->confirmation_code,
              "activated"  => (boolean)$this->activated,
              "free_serial"  => $this->free_serial,
              "batch_id"  => $this->batch_id,
              "product"  => $this->product_id,
              "pharmacy_users_id"  => $this->pharmacy_users_id,
             "created_at"  => $this->created_at->format('d/m/Y h:i A'),
        ];
    }
}
