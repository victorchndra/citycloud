<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    public function scopeCari($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('category','LIKE','%'.$search.'%');
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
