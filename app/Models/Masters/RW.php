<?php

namespace App\Models\Masters;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

class RW extends Model
{
    use HasFactory;
   
    protected $guarded = ['id'];
    use SoftDeletes;//add soft delete
    protected $dates = ['deleted_at'];

  
    protected static function boot()
    {
        parent::boot();
    }
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeCari($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name','LIKE','%'.$search.'%');
        });
    }

    
    public function createdUser()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
    
    public function updatedUser()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

}
