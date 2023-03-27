<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable=['serial','doctor_id'];

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id')->withDefault();
    }
}
