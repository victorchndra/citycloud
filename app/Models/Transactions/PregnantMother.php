<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

// mau nulis acessor dan mutator di laravel 9? pake ini
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Arr;

use Carbon\Carbon;

class PregnantMother extends Model
{
    use HasFactory;
    use SoftDeletes;//add soft delete

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function Mother(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }   
    public function scopeFilter($query, array $filters) {
        $q = $query;


        if(isset($filters['citizen_id'])) {
            $q->where('citizen_id', 'like', ($filters['citizen_id']) ? ('%' . str_replace('','%20',$filters['citizen_id']) . '%') : '')->get();
        }
        if(isset($filters['weight'])) {
            $q->where('weight', 'like', ($filters['weight']) ? ('%' . str_replace('','%20',$filters['weight']) . '%') : '')->get();
        }
        if(isset($filters['height'])) {
            $q->where('height', 'like', ($filters['height']) ? ('%' . str_replace('','%20',$filters['height']) . '%') : '')->get();
        }        
        if(isset($filters['pregnant_to'])) {
            $q->where('pregnant_to', 'like', ($filters['pregnant_to']) ? ('%' . str_replace('','%20',$filters['pregnant_to']) . '%') : '')->get();
        }        
        if(isset($filters['gestational_age'])) {
            $q->where('gestational_age', 'like', str_replace('','%20',$filters['gestational_age']))->get();
        }
        if(isset($filters['disease'])) {
            $q->where('disease', 'like', str_replace('','%20',$filters['disease']))->get();
        }       
        if(isset($filters['lila'])) {
            $q->where('lila', 'like', str_replace('','%20',$filters['lila']))->get();
        }
        if(isset($filters['check_pregnancy'])) {
            $q->where('check_pregnancy', 'like', str_replace('','%20',$filters['check_pregnancy']))->get();
        }
        if(isset($filters['number_lives'])) {
            $q->where('number_lives', 'like', str_replace('','%20',$filters['number_lives']))->get();
        }
        if(isset($filters['number_death'])) {
            $q->where('number_death', 'like', str_replace('','%20',$filters['number_death']))->get();
        }
        if(isset($filters['meninggal'])) {
            $q->where('meninggal', 'like', str_replace('','%20',$filters['meninggal']))->get();
        }
        if(isset($filters['tt1'])) {
            $q->where('tt1', 'like', str_replace('','%20',$filters['tt1']))->get();
        }
        if(isset($filters['tt2'])) {
            $q->where('tt2', 'like', str_replace('','%20',$filters['tt2']))->get();
        }
        if(isset($filters['tt3'])) {
            $q->where('tt3', 'like', str_replace('','%20',$filters['tt3']))->get();
        }
        if(isset($filters['tt4'])) {
            $q->where('tt4', 'like', str_replace('','%20',$filters['tt4']))->get();
        }
        if(isset($filters['tt5'])) {
            $q->where('tt5', 'like', str_replace('','%20',$filters['tt5']))->get();
        }
        

        return $q;

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
    public function motherUser()
    {
        return $this->belongsTo('App\Models\Transactions\Citizens', 'citizen_id', 'id');
    }
}
