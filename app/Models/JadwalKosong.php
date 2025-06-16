<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JadwalKosong extends Model
{
    public function get_all_jadwal_kosong(){
        $data = DB::select("
            SELECT
            p.*, 
            jk.TANGGAL_KOSONG, 
            jk.WAKTU_KOSONG
        FROM 
            jadwal_kosong jk
        JOIN 
            pengajuan p ON jk.ID_PENGAJUAN = p.ID_PENGAJUAN
          ");
        return $data;
    }
}
