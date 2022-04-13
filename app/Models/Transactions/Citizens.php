<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

// mau nulis acessor dan mutator di laravel 9? pake ini
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Arr;

use Carbon\Carbon;

class Citizens extends Model
{
    use HasFactory;
    use SoftDeletes;//add soft delete

    protected $guarded = [];
    protected $dates = ['deleted_at'];


    //ACESSOR
     //ini biar semua yg ke model ini kolom nama jadi huruf besar.mantab. ga perlu ke view 1 1 strtoupper
    //public function get<NamaKolomTabel>Attribute($value)
    //{ return ....($value); }
    //disarankan tulisan camel case, jadi jika punya nama table tanggal_lahir, maka cara panggilnya:
    //getTanggalLahirAttribute()

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }


    // MUTATOR
    //fungsi mutator kurang lebih sama spt accessor.
    // misalnya kita ingin menseragamkan hasil inputan user itu tulisanya kecil semua tidak ada tulisan capitalize, all capss, dll
    // tanpa mengubah form satu satu strtolower, bagus pake asesor aja.

    public function setNamettribute($value)
    {
    $this->attributes['nama'] = strtoupper($value);
    }

    // Cara nulis acessor dan mutator di lv9
    //ingat, jika table menggunakan underscore ex: place_birth, maka cara manggilnya placeBirth();
    //otherwise,not working cuy.

    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function placeBirth(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }


    public function dateBirth(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d', $this->attributes['date_birth'])->isoFormat('D MMMM Y'),

        );
    }

    public function address(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function job(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => strtoupper($value),
        );
    }

    public function religion(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function blood(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => strtoupper($value),
        );
    }

    public function familyStatus(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function marriage(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function fatherName(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function motherName(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function lastEducation(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => strtoupper($value),
        );
    }


    public function healthAssurance(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => strtoupper($value),
        );
    }

    public function dtks(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => strtoupper($value),
        );
    }


    public function disability(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }


    public function vaccine1(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function vaccine2(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function vaccine3(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }


    public function village(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function subDistricts(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function districts(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function province(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
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



    // gunakan scope utk query yg sering dipakai
    // contoh utk user yg aktif saja

    // Function ini digunakan untuk melakukan pencarian (search)
    public function scopeFilter($query, array $filters) {
        $q = $query;


        if(isset($filters['name'])) {
            $q->where('name', 'like', ($filters['name']) ? ('%' . str_replace('','%20',$filters['name']) . '%') : '')->get();
        }
        if(isset($filters['nik'])) {
            $q->where('nik', 'like', ($filters['nik']) ? ('%' . str_replace('','%20',$filters['nik']) . '%') : '')->get();
        }
        if(isset($filters['kk'])) {
            $q->where('kk', 'like', ($filters['kk']) ? ('%' . str_replace('','%20',$filters['kk']) . '%') : '')->get();
        }
        if(isset($filters['date_birth']) && isset($filters['date_birth2'])) {
            // $age = Carbon::parse($filters['date_birth'])->format('Y-m-d');
            $age = $filters['date_birth'];
            $age2 = $filters['date_birth2'];

            $now = (Carbon::now()->year)-$age;
            $now2 = (Carbon::now()->year)-$age2;

            $tgl = Carbon::now()->format('-m-d');
            // dd($now . '-01-01 ' . $now2);
            // dd($age. " Years, " . $age2 . " Years");
            // $date = $q->get('date_birth');
            // dd($date);
            // dd(($now2 . $tgl), ($now . $tgl));

            // get tanggal sekarang, kemudian tahunnya dikurang dari inputan user
            // in1 : tanggal sekarang (tahun) dikurang dengan 2 (inputan user), Ex : 2022-02-20 menjadi 2020-02-20
            // in2 : sama dengan in1, jadi nnti var ini digunakan untuk perbandingan (whereBetween), Ex : 2022-02-20 menjadi 2018-02-20
            // $q->whereBetween('date_birth', [$in2, $in1])->get();
            // $age = dd(Carbon::parse($filters['date_birth'])->diff(Carbon::now())->y);
            // $q->whereBetween('date_birth', [($now2 . $tgl), ($now . $tgl)])->get();
            $q->whereDate('date_birth','<=', ($now2 . $tgl))
              ->whereDate('date_birth','<=', ($now . $tgl))
              ->get();
        }
        if(isset($filters['place_birth'])) {
            $q->where('place_birth', 'like', ($filters['place_birth']) ? ('%' . str_replace('','%20',$filters['place_birth']) . '%') : '')->get();
        }
        if(isset($filters['religion'])) {
            $q->where('religion', 'like', ($filters['religion']) ? ('%' . str_replace('','%20',$filters['religion']) . '%') : '')->get();
        }
        if(isset($filters['family_status'])) {
            $q->where('family_status', 'like', ($filters['family_status']) ? ('%' . str_replace('','%20',$filters['family_status']) . '%') : '')->get();
        }
        if(isset($filters['health_assurance'])) {
            $q->where('health_assurance', 'like', ($filters['health_assurance']) ? ('%' . str_replace('','%20',$filters['health_assurance']) . '%') : '')->get();
        }
        if(isset($filters['dtks'])) {
            $q->where('dtks', 'like', ($filters['dtks']) ? ('%' . str_replace('','%20',$filters['dtks']) . '%') : '')->get();
        }
        if(isset($filters['last_education'])) {
            $q->where('last_education', 'like', ($filters['last_education']) ? ('%' . str_replace('','%20',$filters['last_education']) . '%') : '')->get();
        }
        if(isset($filters['gender'])) {
            $q->where('gender', 'like', str_replace('','%20',$filters['gender']))->get();
        }
        if(isset($filters['blood'])) {
            $q->where('blood', 'like', str_replace('','%20',$filters['blood']))->get();
        }
        if(isset($filters['job'])) {
            $q->where('job', 'like', ($filters['job']) ? ('%' . str_replace('','%20',$filters['job']) . '%') : '')->get();
        }
        if(isset($filters['phone'])) {
            $q->where('phone', 'like', ($filters['phone']) ? ('%' . str_replace('','%20',$filters['phone']) . '%') : '')->get();
        }
        if(isset($filters['marriage'])) {
            $q->where('marriage', 'like', str_replace('','%20',$filters['marriage']))->get();
        }
        if(isset($filters['vaccine_1'])) {
            $q->where('vaccine_1', 'like', str_replace('','%20',$filters['vaccine_1']))->get();
        }
        if(isset($filters['vaccine_2'])) {
            $q->where('vaccine_2', 'like',str_replace('','%20',$filters['vaccine_2']))->get();
        }
        if(isset($filters['vaccine_3'])) {
            $q->where('vaccine_3', 'like',str_replace('','%20',$filters['vaccine_3']))->get();
        }
        if(isset($filters['move_date'])) {
            $q->where('move_date', 'like', ($filters['move_date']) ? ('%' . str_replace('','%20',$filters['move_date']) . '%') : '')->get();
        }
        if(isset($filters['death_date'])) {
            $q->where('death_date', 'like', ($filters['death_date']) ? ('%' . str_replace('','%20',$filters['death_date']) . '%') : '')->get();
        }
        if(isset($filters['rt'])) {
            $q->where('rt', 'like', ($filters['rt']) ? ('%' . str_replace('','%20',$filters['rt']) . '%') : '')->get();
        }
        if(isset($filters['rw'])) {
            $q->where('rw', 'like', ($filters['rw']) ? ('%' . str_replace('','%20',$filters['rw']) . '%') : '')->get();
        }
        if(isset($filters['village'])) {
            $q->where('village', 'like', ($filters['village']) ? ('%' . str_replace('','%20',$filters['village']) . '%') : '')->get();
        }
        if(isset($filters['districts'])) {
            $q->where('districts', 'like', ($filters['districts']) ? ('%' . str_replace('','%20',$filters['districts']) . '%') : '')->get();
        }
        if(isset($filters['sub_districts'])) {
            $q->where('sub_districts', 'like', ($filters['sub_districts']) ? ('%' . str_replace('','%20',$filters['sub_districts']) . '%') : '')->get();
        }
        if(isset($filters['province'])) {
            $q->where('province', 'like', ($filters['province']) ? ('%' . str_replace('','%20',$filters['province']) . '%') : '')->get();
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

