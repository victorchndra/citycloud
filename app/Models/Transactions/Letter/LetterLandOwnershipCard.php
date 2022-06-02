<?php

namespace App\Models\Transactions\Letter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete
use Illuminate\Database\Eloquent\Casts\Attribute; // mau nulis acessor dan mutator di laravel 9? pake ini
use Carbon\Carbon;

class LetterLandOwnershipCard extends Model
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

    public function letterStreet(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }
    
    // public function letterRw(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => strtoupper($value),
    //         set: fn ($value) => strtolower($value),
    //     );
    // }

    // public function letterRt(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => strtoupper($value),
    //         set: fn ($value) => strtolower($value),
    //     );
    // }
    // public function letterRt(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => strtoupper($value),
    //         set: fn ($value) => strtolower($value),
    //     );
    // }

    public function letterVilage(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterSubDistricts(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterDistricts(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterProvince(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterNorth(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterEast(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterWest(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterSouth(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterTotalArea(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterFatherName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }
    public function letterFatherNameBin(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }
    public function letterYear(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterEvidence1(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function letterEvidence2(): Attribute
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
