<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class User extends Controller
{

    private $ModelUser, $ModelSiteDetail, $ModelSite, $public_path;

    public function __construct()
    {
        $this->public_path = 'foto';
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Pengguna',
            'subTitle'          => 'Daftar',
            'daftarUser'        => Users::orderBy('created_at', 'DESC')->limit(300)->get(),
            'user'              => Users::find(Session()->get('id')),
        ];

        return view('user.index', $data);
    }

    public function detail($userId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Pengguna',
            'subTitle'          => 'Detail',
            'detail'            => Users::find($userId),
            'user'              => Users::find('id', Session()->get('id')),
            'form'              => 'Detail'
        ];

        return view('user.form', $data);
    }

    public function new(Request $request)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->username) {
            $data = [
                'title'     => 'Data Pengguna',
                'subTitle'  => 'Tambah',
                'user'      => Users::find(Session()->get('id')),
                'form'      => 'Tambah',
            ];
            return view('user.form', $data);
        } else {
            $validateData = $request->validate([
                'nama'          => 'required',
                'username'      => 'required',
                'email'         => 'required|unique:users,email',
                'password'      => 'min:6|required',
                'role'          => 'required',
                'foto'          => 'required|mimes:jpeg,png,jpg|max:2048'
            ], [
                'nama.required'         => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'email.unique'          => 'Email sudah digunakan!',
                'password.required'     => 'Password harus diisi!',
                'password.min'          => 'Password minikal 6 karakter!',
                'role.required'         => 'Role harus diisi!',
                'foto.required'         => 'Foto harus diisi!',
                'foto.mimes'            => 'Format Foto harus jpg/jpeg/png!',
                'foto.max'              => 'Ukuran Foto maksimal 2 mb',
            ]);

            $file = $validateData['foto'];
            $fileName = date('mdYHis') . ' ' . $validateData['nama'] . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);
            
            $user = new Users();
            $user->nama          = $validateData['nama'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            $user->password      = Hash::make($validateData['password']);
            $user->role          = $validateData['role'];
            $user->foto          = $fileName;
            $user->save;
    
            return redirect()->route('daftar-pengguna')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update(Request $request, $userId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->username) {
            $data = [
                'title'     => 'Data Pengguna',
                'subTitle'  => 'Edit',
                'user'      => Users::find(Session()->get('id')),
                'form'      => 'Edit',
            ];
            return view('user.form', $data);
        } else {
            $validateData = $request->validate([
                'nama'          => 'required',
                'username'      => 'required',
                'email'         => 'required|unique:users,email',
                'role'          => 'required',
                'foto'          => 'mimes:jpeg,png,jpg|max:2048'
            ], [
                'nama.required'         => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'email.unique'          => 'Email sudah digunakan!',
                'role.required'         => 'Role harus diisi!',
                'foto.mimes'            => 'Format Foto harus jpg/jpeg/png!',
                'foto.max'              => 'Ukuran Foto maksimal 2 mb',
            ]);

            $user = Users::find($userId);
            $user->nama          = $validateData['nama'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            $user->role          = $validateData['role'];

            if ($request->password) {
                $user->password = Hash::make(Request()->password);
            }

            if ($request->foto) {
                if ($user->foto) {
                    unlink(public_path($this->public_path) . '/' . $user->foto);
                }

                $file = $request->foto;
                $fileName = date('mdYHis') . $request->nama . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileName);
                $user->foto          = $fileName;
            }

            $user->save;
            return redirect()->route('daftar-pengguna')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($userId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $user = Users::find($userId);

        if ($user->foto) {
            unlink(public_path($this->public_path) . '/' . $user->foto);
        }

        $user->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function profil(Request $request, $userId = null)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$userId) {
            $data = [
                'title'     => 'Profil',
                'subTitle'  => 'Edit Profil',
                'user'      => Users::find(Session()->get('id'))
            ];
            return view('profil.index', $data);
        } else {
            $validateData = $request->validate([
                'nama'          => 'required',
                'username'      => 'required',
                'email'         => 'required',
                'foto'          => 'mimes:jpeg,png,jpg|max:2048'
            ], [
                'nama.required'         => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'foto.mimes'            => 'Format foto harus jpg/jpeg/png!',
                'foto.max'              => 'Ukuran Foto maksimal 2 mb',
            ]);

            $user = Users::find($userId);
            $user->nama          = $validateData['nama'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            
            if ($request->foto) {
                if ($user->foto) {
                    unlink(public_path($this->public_path) . '/' . $user->foto);
                }

                $file = $request->foto;
                $fileName = date('mdYHis') . $request->nama . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileName);
                $user->foto          = $fileName;
            }

            $user->save();
            return back()->with('success', 'Profil berhasil diedit!');
        }
    }

    public function changePassword(Request $request, $userId = null)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->password_lama) {
            $data = [
                'title'     => 'Profil',
                'subTitle'  => 'Ubah Password',
                'user'      => Users::find(Session()->get('id'))
            ];
            return view('profil.ubahPassword', $data);
        } else {
            $validateData = $request->validate([
                'password_lama'     => 'required|min:6',
                'password_baru'     => 'required|min:6',
            ], [
                'password_lama.required'    => 'Password Lama harus diisi!',
                'password_lama.min'         => 'Password Lama minikal 6 karakter!',
                'password_baru.required'    => 'Password Baru harus diisi!',
                'password_baru.min'         => 'Password Lama minikal 6 karakter!',
            ]);
    
            $user = Users::find($userId);
    
            if (Hash::check($validateData['password_lama'], $user->password)) {

                $user->password = Hash::make($validateData['password_baru']);
    
                $user->save();
                return back()->with('success', 'Password berhasil diubah!');
            } else {
                return back()->with('failed', 'Password lama tidak sesuai.');
            }
        }
    }
}
