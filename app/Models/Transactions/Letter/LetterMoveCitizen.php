<?php

namespace App\Models\Transactions\Letter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete
use Illuminate\Database\Eloquent\Casts\Attribute; // mau nulis acessor dan mutator di laravel 9? pake ini
use Carbon\Carbon;

class LetterMoveCitizen extends Model
{
    use HasFactory;
    use SoftDeletes;//add soft delete

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function letterName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }   

    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }


    public function gender(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function placeBirth(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function dateBirth(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['date_birth'])->isoFormat('D MMMM Y'),
            // get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['date_birth'])->isoFormat('YYYY-MM-DD'),
        );
    }

    public function religion(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function job(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function address(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    // public function letterDate(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['letter_date'])->isoFormat('D MMMM Y'),
    //         // get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['date_birth'])->isoFormat('YYYY-MM-DD'),
    //     );
    // }
    
    // public function startDate(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['start_date'])->isoFormat('D MMMM Y'),
    //         // get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->isoFormat('D MMMM Y'),
    //     );
    // }
    
    // public function endDate(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->isoFormat('D MMMM Y'),
    //         // get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->isoFormat('D MMMM Y'),
    //     );
    // }

    public function validUntil(): Attribute
    {
        return new Attribute(
            // get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['valid_until'])->isoFormat('D MMMM Y'),
            // get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['date_birth'])->isoFormat('YYYY-MM-DD'),
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
    
}