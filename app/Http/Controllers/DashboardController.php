<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data ['title']= 'Dashboard';
        return view('template.header',$data).
            view('template.sidebar', $data).
            view('dashboard').
            view('template.footer');
    }
}
