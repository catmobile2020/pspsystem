<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =['name','description','paid_num','free_num','company_id','program_id'];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable')->withDefault([
            'url'=>asset('assets/images/default-image.png')
        ]);
    }
    public function getPhotoAttribute()
    {
        return $this->image->full_url;
    }

    public function trash()
    {
        $photo = public_path($this->image->url);
        if (is_file($photo))
        {
            @unlink($photo);
            $this->image()->delete();
        }
        $this->delete();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function callCenters()
    {
        return $this->hasMany(CallCenter::class);
    }
}
