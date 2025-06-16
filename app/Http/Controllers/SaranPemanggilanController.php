<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaranPemanggilanController extends Controller
{
    public function index(){
        $data ['title']= 'Saran';
        return view('template.header',$data).
            view('template.sidebar', $data).
            view('saran_pemanggilan').
            view('template.footer');
    }
}
