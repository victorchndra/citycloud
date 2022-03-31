<?php
  
namespace App\Exports;
  
use App\Models\Transactions\Citizens;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class CitizenExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Citizens::select("nik", "kk", "name","gender","date_birth","place_birth","religion",
        "family_status","blood","job","phone","marriage","vaccine_1","vaccine_2","vaccine_3","rt","rw",
        "village","sub_districts","districts","province")->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function actions(Request $request)
    {
        return [
            (new DownloadExcel)->allFields(),
        ];
    }
        
    public function headings(): array
    {
        return ["NIK", "KK", "NAMA", "JENIS KELAMIN","TANGGAL LAHIR","TEMPAT LAHIR","AGAMA","STATUS","GOL_DARAH","PEKERJAAN","TELP","STATUS_NIKAH","VAKSIN_1",
        "VAKSIN_2","VAKSIN_3","RT","RW","KELURAHAN","KECAMATAN","KOTA","PROVINSI"];
    }
}