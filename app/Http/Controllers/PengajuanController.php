<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function index(){
        $data['title'] = 'Pengajuan';
    
        $jadwal_kosong = DB::table('jadwal_kosong')
                            ->where('STATUS', 0)
                            ->get();
        $data['user'] = DB::selectOne("
        SELECT
            u.*,
            m.*
        FROM
            users u
        LEFT JOIN
            mahasiswa m ON u.email = m.EMAIL_MAHASISWA
        WHERE
            u.email = '" . session('users')[0]['email'] . "'
    ");
        $jadwal_kosong = $jadwal_kosong->map(function ($item) {
            $item->hari = Carbon::parse($item->TANGGAL_KOSONG)->translatedFormat('l');
            return $item;
        });
    
        $data['jadwal_kosong'] = $jadwal_kosong;
        $data['pengajuan'] = DB::select("SELECT * FROM pengajuan");
 
        return view('template.header', $data)
            . view('template.sidebar', $data)
            . view('pengajuan', $data)
            . view('template.footer');
    }

    public function ajukan(Request $request) {
        $pengajuan = DB::table('jadwal_kosong')->where('ID_JADWAL_KOSONG', $request->input('id_pengajuan'))->first();
    
        if (!$pengajuan) {
            return back()->with('error', 'Data pengajuan tidak ditemukan.');
        }
    
        $tanggal = Carbon::parse($pengajuan->TANGGAL_KOSONG)->format('Y-m-d');
        $waktu = Carbon::parse($pengajuan->WAKTU_KOSONG)->format('H:i:s');
        $jadwalKonseling = $tanggal . ' ' . $waktu;
    
        $data['pengajuan'] = [
            'ID_PENGAJUAN'        => $this->GenerateUniqID($pengajuan->WAKTU_KOSONG),
            'NRP'                 => $request->input('nrp'),
            'TANGGAL_KOSONG'      => $tanggal,
            'JADWAL_KONSELING'    => $jadwalKonseling,
            'STATUS_PENGAJUAN'    => "Mengajukan",
            'WAKTU_KOSONG'        => $waktu,
        ];
    
        $data['keluhan'] = [ 
            'ID_KELUHAN'          => $this->GenerateUniqID($request->input('keluhan')),
            'ID_PENGAJUAN'        => $data['pengajuan']['ID_PENGAJUAN'],
            'KATEGORI_KELUHAN'    => $request->input('kategori_keluhan'),
            'DESKRIPSI_KELUHAN'   => $request->input('keluhan')
        ];

        
        DB::table('pengajuan')->insert($data['pengajuan']);
        DB::table('keluhan')->insert($data['keluhan']);
        DB::table('jadwal_kosong')
        ->where('ID_JADWAL_KOSONG', $request->input('id_pengajuan'))
        ->update(['STATUS' => 1]);
        
        return redirect('pengajuan')->with('succ_msg','Successfully Add New Pengajuan');
    }
    
    public function GenerateUniqID($var)
    {
        $string = preg_replace('/[^a-z]/i', '', $var);
        $vocal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
        $scrap = str_replace($vocal, "", $string);
        $begin = substr($scrap, 0, 4);
        $uniqid = strtoupper($begin);
        return "PGJN_" . $uniqid . substr(md5(time()), 0, 3);
    }
    public function update(){

    }
}
