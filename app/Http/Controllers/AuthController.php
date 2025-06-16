<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        {
            $data['title'] = 'Login';
            return view('template.header', $data).
            view('login', $data).
            view('template.footer');
        }
    }

    public function login(Request $request)
    {
        $auth = DB::selectOne("
        SELECT
            users.*
        FROM
            users
        WHERE
            users.email = '" . $request->input('email') . "'
        AND
            users.password = '" . $request->input('password') . "'");
            
        if ($auth == null) {
            return redirect()->back()->with('msg_auth', "Email or Password Wrong");
        }

        if (!empty($auth)) {
            if ($auth->id_role == 1) {
                $user_data = collect([
                    'id' => $auth->id,
                    'name' => $auth->name,
                    'id_role' => $auth->id_role,
                    'email' => $auth->email,
                    'LOGGED_IN' => TRUE
                ]);
                
                Session::push('users', $user_data);
                // dd($auth,$user_data );

                return redirect('/');
            } elseif ($auth->id_role == 2) {

                $user_data = collect([
                    'id' => $auth->id,
                    'name' => $auth->name,
                    'id_role' => $auth->id_role,
                    'email' => $auth->email,
                    'LOGGED_IN' => TRUE
                ]);

                Session::push('users', $user_data);
                return redirect('/');
            } elseif ($auth->id_role == 3) {

                $user_data = collect([
                    'id' => $auth->id,
                    'name' => $auth->name,
                    'id_role' => $auth->id_role,
                    'email' => $auth->email,
                    'LOGGED_IN' => TRUE
                ]);

                Session::push('users', $user_data);
                return redirect('/');
            }
        } else {
            dd($request);
            return redirect('login')->with('resp_msg', "Your Session Expired");
        }
    }

    public function showRegisterForm()
    {
        $data['title'] = 'Register';
        return view('template.header', $data).
        view('register', $data).
        view('template.footer');
    }


    public function register(Request $request)
    {

        $check_user = DB::table('users')
        ->where('email', $request->input('email'))
        ->get();
    if ($check_user->isEmpty())
 {
     try { 
                // dd($request);
                
                $user = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'no_telepon' => $request->input('no_telepon'),
                    'password' => $request->input('password'),
                    'id_role' => $request->input('role'),
                ];
                DB::table('users')->insert($user);
              
                if ($request->input('role') == 1) {
                    // Insert ke tabel mahasiswa
                    $mhs = [
                        'NAMA_MAHASISWA' => $request->input('name'),
                        'NRP' => $request->input('nrp'),
                        'PRODI' => $request->input('prodi'),
                        'EMAIL_MAHASISWA' => $request->input('email'),
                        'NO_HP' => $request->input('no_telepon')
                    ];
                    DB::table('mahasiswa')->insert($mhs);
                } else {
                    // Insert ke tabel staf (baik Staf biasa atau Dosen)
                    $staf =[
                        'ID_STAF' => $this->GenerateUniqID($user['name']),
                        'NAMA_STAF' => $request->input('name'),
                        'NO_HP' => $request->input('no_telepon'),
                        'EMAIL_STAF' => $request->input('email'),
                        'STATUS_STAF' => ($request->input('role') == 2) ? 'Staf' : 'Dosen'
                    ];
                    // dd($staf, $user);
                    DB::table('staf')->insert($staf);
                }
    return redirect('login');
    } catch(Exception $e){
    return 'gagal register';
    }
    }

}
public function GenerateUniqID($var)
    {
        $string = preg_replace('/[^a-z]/i', '', $var);
        $vocal = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
        $scrap = str_replace($vocal, "", $string);
        $begin = substr($scrap, 0, 4);
        $uniqid = strtoupper($begin);
        return "STAF_" . $uniqid . substr(md5(time()), 0, 3);
    }
public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}