<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengajuan extends Model
{
    public function get_all_pengajuan(){
        $data = DB::select("
            SELECT
                *
            FROM
                pengajuan
          ");
        return $data;
    }
}
