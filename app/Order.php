<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['serial_number', 'comment', 'has_free', 'confirmation_code', 'activated', 'batch_id','free_serial','product_id','patient_id', 'pharmacy_id'];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getHasFreePhotoAttribute()
    {
        return $this->has_free ? asset('assets/images/free.png') : asset('assets/images/paid.png');
    }
}
