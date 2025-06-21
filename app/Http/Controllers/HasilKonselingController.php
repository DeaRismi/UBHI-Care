<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilKonselingController extends Controller
{
    public function index(){
        $data ['title']= 'Hasil Konseling';

//         $data['hasil_konseling'] = DB::select("
//     SELECT p.*, m.*, k.*
//     FROM pengajuan p
//     LEFT JOIN keluhan k ON p.ID_PENGAJUAN= k.ID_PENGAJUAN
//     JOIN mahasiswa m ON p.NRP = m.NRP
// ");

$data['hasil_konseling'] = DB::select("
    SELECT p.*, m.*, k.*, ks.ID_KONSELING, ks.HASIL_KONSELING, ks.CATATAN_KONSELING
    FROM pengajuan p
    LEFT JOIN keluhan k ON p.ID_PENGAJUAN = k.ID_PENGAJUAN
    JOIN mahasiswa m ON p.NRP = m.NRP
    LEFT JOIN konseling ks ON ks.ID_PENGAJUAN = p.ID_PENGAJUAN
");

       
        return view('template.header',$data).
            view('template.sidebar', $data).
            view('hasil_konseling', $data).
            view('template.footer');
    }

    public function inputhasil(Request $request) {
        $id_pengajuan = $request->input('id_pengajuan'); // pastikan ini dikirim dari form
        $id_staf = DB::table('staf')
            ->leftJoin('users', 'staf.EMAIL_STAF', '=', 'users.email')
            ->where('users.id', session('users')[0]['id'])
            ->value('ID_STAF');
    
        // Cek apakah sudah ada data konseling untuk ID_PENGAJUAN tersebut
        $existing = DB::table('konseling')->where('ID_PENGAJUAN', $id_pengajuan)->first();
    
        // Ambil JADWAL dan TANGGAL dari pengajuan
        $pengajuan = DB::table('pengajuan')->where('ID_PENGAJUAN', $id_pengajuan)->first();
    
        if (!$pengajuan) {
            return back()->with('error', 'Pengajuan tidak ditemukan.');
        }
    
        $data = [
            'ID_PENGAJUAN' => $id_pengajuan,
            'ID_STAF' => $id_staf,
            'HASIL_KONSELING' => $request->input('hasil_konseling'),
            'CATATAN_KONSELING' => $request->input('catatan_tambahan'),
            'JADWAL_KONSELING' => $pengajuan->JADWAL_KONSELING,
            'STATUS_KONSELING' => 'Selesai',
            'TANGGAL_KONSELING' => $pengajuan->TANGGAL_KOSONG
        ];
    
        if ($existing) {
            // Update data konseling yang sudah ada
            DB::table('konseling')->where('ID_PENGAJUAN', $id_pengajuan)->update($data);
        } else {
            // Tambah ID_KONSELING jika belum ada dan insert baru
            $data['ID_KONSELING'] = $this->GenerateUniqID($id_pengajuan);
            DB::table('konseling')->insert($data);
        }
    
        // Update status pengajuan ke "Selesai"
        DB::table('pengajuan')->where('ID_PENGAJUAN', $id_pengajuan)->update([
            'STATUS_PENGAJUAN' => 'Selesai'
        ]);
    
        return redirect('hasil_konseling')->with('succ_msg', 'Data berhasil disimpan.');
    }
    

    public function gethasil(Request $request){
        $hasil = DB::table('konseling')
        ->select('HASIL_KONSELING', 'CATATAN_KONSELING')
        ->where('ID_KONSELING', $request->input('id_konseling'))
        ->first();

    if ($hasil) {
        return response()->json(['data' => $hasil]);
    } else {
        return response()->json(['data' => null], 404);
    }
        
    }
    public function GenerateUniqID($var)
    {
        $string = preg_replace('/[^a-z]/i', '', $var);
        $vocal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
        $scrap = str_replace($vocal, "", $string);
        $begin = substr($scrap, 0, 4);
        $uniqid = strtoupper($begin);
        return "HK_" . $uniqid . substr(md5(time()), 0, 3);
    }

    public function lihatriwayat(Request $request){
        $id_mahasiswa = $request-> input('id_mahasiswa');
        $riwayat = DB::select("
        SELECT *
FROM pengajuan
LEFT JOIN keluhan ON keluhan.ID_PENGAJUAN = pengajuan.ID_PENGAJUAN
LEFT JOIN konseling ON konseling.ID_PENGAJUAN = pengajuan.ID_PENGAJUAN
LEFT JOIN mahasiswa.NRP = pengajuan.NRP
WHERE pengajuan.NRP = '". $id_mahasiswa."'
        ");
        dd($riwayat);
    }
}

