<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

// mau nulis acessor dan mutator di laravel 9? pake ini
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Arr;

use Carbon\Carbon;

class KidsWeight extends Model
{
    use HasFactory;
    use SoftDeletes;//add soft delete

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
  

    public function imdb(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }


    public function methodMeasure(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function vitamin(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }
    

    public function kms(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function booster(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function e1(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function e2(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function e3(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function e4(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function e5(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function e6(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }
    
   

    public function createdUser()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
    public function updatedUser()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'signed_by', 'id');
    }

    public function scopeFilter($query, array $filters) {
        $q = $query;


        if(isset($filters['nik'])) {
            $q->where('nik', 'like', ($filters['nik']) ? ('%' . str_replace('','%20',$filters['nik']) . '%') : '')->get();
        }
        if(isset($filters['name'])) {
            $q->where('name', 'like', ($filters['name']) ? ('%' . str_replace('','%20',$filters['name']) . '%') : '')->get();
        }
        if(isset($filters['weight'])) {
            $q->where('weight', 'like', ($filters['weight']) ? ('%' . str_replace('','%20',$filters['weight']) . '%') : '')->get();
        }        
        if(isset($filters['height'])) {
            $q->where('height', 'like', ($filters['height']) ? ('%' . str_replace('','%20',$filters['height']) . '%') : '')->get();
        }        
        if(isset($filters['imdb'])) {
            $q->where('imdb', 'like', str_replace('','%20',$filters['imdb']))->get();
        }
        if(isset($filters['headWidth'])) {
            $q->where('headWidth', 'like', str_replace('','%20',$filters['headWidth']))->get();
        }       
        if(isset($filters['method_measure'])) {
            $q->where('method_measure', 'like', str_replace('','%20',$filters['method_measure']))->get();
        }
        if(isset($filters['vitamin'])) {
            $q->where('vitamin', 'like', str_replace('','%20',$filters['vitamin']))->get();
        }
        if(isset($filters['kms'])) {
            $q->where('kms', 'like', str_replace('','%20',$filters['kms']))->get();
        }
        if(isset($filters['imunitation'])) {
            $q->where('imunitation', 'like', str_replace('','%20',$filters['imunitation']))->get();
        }
        if(isset($filters['booster'])) {
            $q->where('booster', 'like', str_replace('','%20',$filters['booster']))->get();
        }
        if(isset($filters['e1'])) {
            $q->where('e1', 'like', str_replace('','%20',$filters['e1']))->get();
        }
        if(isset($filters['e2'])) {
            $q->where('e2', 'like', str_replace('','%20',$filters['e2']))->get();
        }
        if(isset($filters['e3'])) {
            $q->where('e3', 'like', str_replace('','%20',$filters['e3']))->get();
        }
        if(isset($filters['e4'])) {
            $q->where('e4', 'like', str_replace('','%20',$filters['e4']))->get();
        }
        if(isset($filters['e5'])) {
            $q->where('e5', 'like', str_replace('','%20',$filters['e5']))->get();
        }
        if(isset($filters['e6'])) {
            $q->where('e6', 'like', str_replace('','%20',$filters['e6']))->get();
        }
        if(isset($filters['notes'])) {
            $q->where('notes', 'like', ($filters['notes']) ? ('%' . str_replace('','%20',$filters['notes']) . '%') : '')->get();
        } 
        

        return $q;

        // BACKUP
        // if(isset($filters['name']) || isset($filters['gender']) || isset($filters['nik']) || isset($filters['kk']) || isset($filters['date_birth']) || isset($filters['place_birth']) || isset($filters['religion']) || isset($filters['family_status']) || isset($filters['blood']) || isset($filters['job']) || isset($filters['phone']) || isset($filters['marriage']) || isset($filters['vaccine_1']) || isset($filters['vaccine_2']) || isset($filters['vaccine_3']) || isset($filters['move_date']) || isset($filters['death_date']) || isset($filters['rt']) || isset($filters['rw']) || isset($filters['village']) || isset($filters['sub_districts']) || isset($filters['districts']) || isset($filters['province'])) {
        //     return $query->where('name', 'like', ($filters['name']) ? ('%' . str_replace('','%20',$filters['name']) . '%') : '')
        //                 ->orWhere('gender', 'like', str_replace('','%20',$filters['gender']))
        //                 ->orWhere('nik', 'like', ($filters['nik']) ? ('%' . str_replace('','%20',$filters['nik']) . '%') : '')
        //                 ->orWhere('kk', 'like', ($filters['kk']) ? ('%' . str_replace('','%20',$filters['kk']) . '%') : '')
        //                 ->orWhere('date_birth', 'like', ($filters['date_birth']) ? ('%' . str_replace('','%20',$filters['date_birth']) . '%') : '')
        //                 ->orWhere('place_birth', 'like', ($filters['place_birth']) ? ('%' . str_replace('','%20',$filters['place_birth']) . '%') : '')
        //                 ->orWhere('religion', 'like', str_replace('','%20',$filters['religion']))
        //                 ->orWhere('family_status', 'like', str_replace('','%20',$filters['family_status']))
        //                 ->orWhere('blood', 'like', str_replace('','%20',$filters['blood']))
        //                 ->orWhere('job', 'like', ($filters['job']) ? ('%' . str_replace('','%20',$filters['job']) . '%') : '')
        //                 ->orWhere('phone', 'like', ($filters['phone']) ? ('%' . str_replace('','%20',$filters['phone']) . '%') : '')
        //                 ->orWhere('marriage', 'like', str_replace('','%20',$filters['marriage']))
        //                 ->orWhere('vaccine_1', 'like', ($filters['vaccine_1']) ? ('%' . str_replace('','%20',$filters['vaccine_1']) . '%') : '')
        //                 ->orWhere('vaccine_2', 'like', ($filters['vaccine_2']) ? ('%' . str_replace('','%20',$filters['vaccine_2']) . '%') : '')
        //                 ->orWhere('vaccine_3', 'like', ($filters['vaccine_3']) ? ('%' . str_replace('','%20',$filters['vaccine_3']) . '%') : '')
        //                 ->orWhere('move_date', 'like', ($filters['move_date']) ? ('%' . str_replace('','%20',$filters['move_date']) . '%') : '')
        //                 ->orWhere('death_date', 'like', ($filters['death_date']) ? ('%' . str_replace('','%20',$filters['death_date']) . '%') : '')
        //                 ->orWhere('rt', 'like', ($filters['rt']) ? ('%' . str_replace('','%20',$filters['rt']) . '%') : '')
        //                 ->orWhere('rw', 'like', ($filters['rw']) ? ('%' . str_replace('','%20',$filters['rw']) . '%') : '')
        //                 ->orWhere('village', 'like', ($filters['village']) ? ('%' . str_replace('','%20',$filters['village']) . '%') : '')
        //                 ->orWhere('sub_districts', 'like', ($filters['sub_districts']) ? ('%' . str_replace('','%20',$filters['sub_districts']) . '%') : '')
        //                 ->orWhere('districts', 'like', ($filters['districts']) ? ('%' . str_replace('','%20',$filters['districts']) . '%') : '')
        //                 ->orWhere('province', 'like', ($filters['province']) ? ('%' . str_replace('','%20',$filters['province']) . '%') : '');
        // }
    }
}
