<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory,SoftDeletes;

    //eager loading - reduces the number of queries
    protected $with = ['business'];
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'image',
        'business_id',
    ];

    public function business(){
        return $this->belongsTo(Business::class)->withTrashed();
    }
}
