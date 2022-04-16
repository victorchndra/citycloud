<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
