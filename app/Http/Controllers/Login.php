<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use Illuminate\Support\Facades\Mail;
use App\Mail\kirimEmail;
use Illuminate\Http\Request;

class Login extends Controller
{


    public function __construct()
    {

    }

    public function index()
    {
        if (Session()->get('id')) {
            return redirect()->route('dashboard');
        }

        $data = [
            'title'     => 'Login',
            'subTitle'  => 'Login'
        ];

        return view('auth.login', $data);
    }

    public function loginProcess(Request $request)
    {

        $validateData = $request->validate([
            'username'      => 'required',
            'password'      => 'min:6|required',
        ], [
            'username.required' => 'Username/Email harus diisi!',
            'password.required' => 'Password harus diisi!',
            'password.min'      => 'Password minimal 6 karakter!',
        ]);

        $checkLogin = Users::orWhere('username', $validateData['username'])->orWhere('email', $validateData['username'])->first();

        if ($checkLogin) {
            if (Hash::check($validateData['password'], $checkLogin->password)) {
                Session()->put('id', $checkLogin->id);
                Session()->put('role', $checkLogin->role);
                Session()->put('log', true);
                
                return redirect()->route('dashboard');
            } else {
                return back()->with('failed', 'Login gagal! Password tidak sesuai.');
            }
        } else {
            return back()->with('failed', 'Login gagal! Username/Email belum terdaftar.');
        }
    }

    public function logout()
    {
        Session()->forget('id');
        Session()->forget('role');
        Session()->forget('log');
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    // public function forgotPassword()
    // {
    //     if (Session()->get('role')) {
    //         return redirect()->route('dashboard');
    //     }

    //     if(!Request()->email) {
    //         $data = [
    //             'title' => 'Lupa Password'
    //         ];
    //         return view('auth.forgotPassword', $data);
    //     } else {
    //         $email = Request()->email;

    //         $user = $this->ModelUser->findOne('email', $email);
    //         if (!$user) {
    //             return back()->with('failed', 'Email tidak terdaftar.');
    //         }
    //         $id_user = $user->id_user;
    //         $urlReset = 'http://127.0.0.1:8000/reset-password/' . $id_user;

    //         if ($user) {
    //             $data_email = [
    //                 'subject'       => 'Lupa Password',
    //                 'sender_name'   => 'renaldinoviandi1@gmail.com',
    //                 'urlUtama'      => 'http://127.0.0.1:8000',
    //                 'urlReset'      => $urlReset,
    //                 'dataUser'      => $user,
    //             ];

    //             Mail::to($user->email)->send(new kirimEmail($data_email));
    //             return redirect()->route('login')->with('success', 'Kami sudah kirim pesan ke email Anda. Silahkan cek email Anda!');
    //         } else {
    //             return back()->with('failed', 'Email tidak terdaftar.');
    //         }
    //     }
    // }

    // public function resetPassword($id_user)
    // {
    //     if (Session()->get('role')) {
    //         return redirect()->route('dashboard');
    //     }

    //     if(!Request()->password) {
    //         $data = [
    //             'title' => 'Reset Password',
    //             'user'  => $this->ModelUser->findOne('id_user', $id_user),
    //         ];
    //         return view('auth.resetPassword', $data);
    //     } else {
    //         Request()->validate([
    //             'password' => 'required|min:6',
    //             'password_confirmation' => 'required|min:6|same:password',
    //         ], [
    //             'password.required' => 'Password baru harus diisi!',
    //             'password.min' => 'Password baru minimal 6 karakter!',
    //             'password_confirmation.required' => 'Konfirmasi password harus diisi!',
    //             'password_confirmation.min' => 'Konfirmasi password minimal 6 karakter!',
    //             'password_confirmation.same' => 'Konfirmasi password tidak sama!',
    //         ]);

    //         $data = [
    //             'id_user'      => $id_user,
    //             'password'      => Hash::make(Request()->password)
    //         ];

    //         $this->ModelUser->edit($data);
    
    //         return redirect()->route('login')->with('success', 'Anda baru saja merubah password. Silahkan login!');
    //     }
    // }
}
