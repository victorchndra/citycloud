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
    // public function scopeFilter($query, array $filters) {
    //     $query->when($filters['name'] ?? false, function($query, $search) {
    //         return $query->where('name', 'like', $search);
                        // ->orWhere('nik', 'like', '%' . $search . '%')
                        // ->orWhere('kk', 'like', '%' . $search . '%')
                        // ->orWhere('gender', 'like', '%' . $search . '%')
                        // ->orWhere('date_birth', 'like', '%' . $search . '%')
                        // ->orWhere('place_birth', 'like', '%' . $search . '%')
                        // ->orWhere('religion', 'like', '%' . $search . '%')
                        // ->orWhere('family_status', 'like', '%' . $search . '%')
                        // ->orWhere('blood', 'like', '%' . $search . '%')
                        // ->orWhere('job', 'like', '%' . $search . '%')
                        // ->orWhere('phone', 'like', '%' . $search . '%')
                        // ->orWhere('marriage', 'like', '%' . $search . '%')
                        // ->orWhere('vaccine_1', 'like', '%' . $search . '%')
                        // ->orWhere('vaccine_2', 'like', '%' . $search . '%')
                        // ->orWhere('vaccine_3', 'like', '%' . $search . '%')
                        // ->orWhere('move_date', 'like', '%' . $search . '%')
                        // ->orWhere('death_date', 'like', '%' . $search . '%')
                        // ->orWhere('rt', 'like', '%' . $search . '%')
                        // ->orWhere('rw', 'like', '%' . $search . '%')
                        // ->orWhere('village', 'like', '%' . $search . '%')
                        // ->orWhere('sub_districts', 'like', '%' . $search . '%')
                        // ->orWhere('districts', 'like', '%' . $search . '%')
                        // ->orWhere('province', 'like', '%' . $search . '%');
    //     });
    // }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['name'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
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
