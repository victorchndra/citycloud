<?php

//check name space ketika membuat controller dengan --resource, pastikan mengarah ke folder yang tepat.
namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //call soft delete

// mau nulis acessor dan mutator di laravel 9? pake ini
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Arr;

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
    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
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
        if(isset($filters['date_birth'])) {
            $q->where('date_birth', 'like', ($filters['date_birth']) ? ('%' . str_replace('','%20',$filters['date_birth']) . '%') : '')->get();
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

// Identitas pribadi
// 1. nik
// 2. kk
// 3. name
// 4. gender
// 5. date_birth
// 6. place_birth
// 7. religion
// 8. family_status
// 9. blood
// 10. job
// 11. phone
// 12. marriage

// Vaksin
// 12. vaccine_1
// 13. vaccine_2
// 14. vaccine_3

// Lanjutan
// 15. move_date
// 16. death_date

// Alamat
// 17. rt
// 18. rw
// 19. village
// 20. sub_districts
// 21. districts
// 22. province

// Data info
// 23. created_by
// 24. updated_by
// 25. deleted_by
// 26. created_at 	#
// 27. updated_at 	#
// 28. deleted_at
