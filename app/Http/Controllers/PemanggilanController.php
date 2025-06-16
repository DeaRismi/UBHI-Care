<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemanggilanController extends Controller
{
    public function index(){
        $data ['title']= 'Pemanggilan';
        return view('template.header',$data).
            view('template.sidebar', $data).
            view('pemanggilan').
            view('template.footer');
    }
}
