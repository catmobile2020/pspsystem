<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =['name','description','paid_num','free_num','company_id','program_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
