<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranPemanggilanController extends Controller
{
    public function index(){
        $data ['title']= 'Saran';
        $data ['mahasiswa'] = DB::select("
select NRP,NAMA_MAHASISWA,PRODI FROM mahasiswa
        ");

        return view('template.header',$data).
            view('template.sidebar', $data).
            view('saran_pemanggilan', $data).
            view('template.footer');
    }

    public function saran(Request $request){
        $id_staf = DB::selectOne("
        SELECT ID_STAF FROM staf s left join users u ON u.email = s.EMAIL_STAF WHERE email = '".session('users')[0]['email']."'
        ");
      $id_keluhan = $this->GenerateUniqIDkeluhan($request->input('deskripsi_keluhan'));

$data['keluhan'] = [
    'ID_KELUHAN'         => $id_keluhan,
    'KATEGORI_KELUHAN'   => $request->input('kategori_keluhan'),
    'DESKRIPSI_KELUHAN'  => $request->input('deskripsi_keluhan'),
];

$data['saran'] = [
    'ID_SARAN'      => $this->GenerateUniqIDsaran($request->input('deskripsi_keluhan')),
    'NRP'           => $request->input('nrp'),
    'ID_STAF'       => $id_staf->ID_STAF,
    'ID_KELUHAN'    => $id_keluhan,
    'TANGGAL_SARAN' => now()->format('Y-m-d H:i:s'), // format datetime
];

        dd($data);
    }

    public function GenerateUniqIDsaran($var)
    {
        $string = preg_replace('/[^a-z]/i', '', $var);
        $vocal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
        $scrap = str_replace($vocal, "", $string);
        $begin = substr($scrap, 0, 4);
        $uniqid = strtoupper($begin);
        return "SP_" . $uniqid . substr(md5(time()), 0, 3);
    }

     public function GenerateUniqIDkeluhan($var)
    {
        $string = preg_replace('/[^a-z]/i', '', $var);
        $vocal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
        $scrap = str_replace($vocal, "", $string);
        $begin = substr($scrap, 0, 4);
        $uniqid = strtoupper($begin);
        return "KL_" . $uniqid . substr(md5(time()), 0, 3);
    }
}
