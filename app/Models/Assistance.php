<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

class Assistance extends Model
{
    use HasFactory;
    use SoftDeletes;//add soft delete

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function scopeCari($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name','LIKE','%'.$search.'%');
        });
    }
}
