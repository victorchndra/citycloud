<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

class RT extends Model
{
    use HasFactory;
    use SoftDeletes;//add soft delete
    
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
