<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RW extends Model
{
    use HasFactory;
   
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
    }
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
