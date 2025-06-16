<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalKosongController extends Controller
{
    public function index(){
        $data ['title']= 'Jadwal Kosong';
        $data ['jadwal']= DB::select("
        SELECT
            *
        FROM
            jadwal_kosong
      ");
        return view('template.header',$data).
            view('template.sidebar', $data).
            view('jadwal_kosong', $data).
            view('template.footer');
    }

    public function insert(Request $request){
        $data = [
            'TANGGAL_KOSONG' => $request->input('tanggal_kosong'),
            'WAKTU_KOSONG' => $request ->input('waktu_kosong')
        ];
        



        DB::table('jadwal_kosong') ->insert($data);
        return redirect('jadwal_kosong')->with('succ_msg','Successfully');
    }

    public function update(){

    }

    public function delete(){

    }
}
