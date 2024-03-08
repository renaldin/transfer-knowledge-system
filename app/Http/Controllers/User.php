<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class User extends Controller
{

    private $public_path;

    public function __construct()
    {
        $this->public_path = 'photo';
    }

    // public function user() 
    // {
    //     $data = [
    //         'title'             => 'Data Pengguna',
    //         'subTitle'          => 'Daftar',
    //         // 'daftarUser'        => Users::orderBy('created_at', 'DESC')->limit(10000)->get(),
    //         'user'              => Users::find(Session()->get('id')),
    //     ];

    //     return view('user.user', $data);
    // }

    // public function data()
    // {
    //     return DataTables::of(Users::all())->toJson();
    // }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Pengguna',
            'subTitle'          => 'Daftar',
            'user'              => Users::find(Session()->get('id')),
        ];

        if (Request()->keyword) {
            $keyword = Request()->keyword;
            $data['keyword']    = Request()->keyword;
            $data['daftarUser'] =  Users::where('deleted_at', null)
                                    ->where(function($query) use ($keyword) {
                                        $query->where('username', 'like', '%'.$keyword.'%')
                                            ->orWhere('email', 'like', '%'.$keyword.'%')
                                            ->orWhere('name', 'like', '%'.$keyword.'%')
                                            ->orWhere('role', 'like', '%'.$keyword.'%');
                                    })
                                    ->orderBy('created_at', 'DESC')
                                    ->limit(300)
                                    ->get();
        } else {
            $data['daftarUser'] =  Users::where('deleted_at', null)->orderBy('created_at', 'DESC')->limit(300)->get();
            $data['keyword']    = null;
        }

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
            'user'              => Users::find(Session()->get('id')),
            'form'              => 'Detail'
        ];

        return view('user.form', $data);
    }

    public function new(Request $request)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->role) {
            $data = [
                'title'     => 'Data Pengguna',
                'subTitle'  => 'Tambah',
                'user'      => Users::find(Session()->get('id')),
                'form'      => 'Tambah',
            ];
            return view('user.form', $data);
        } else {
            $validateData = $request->validate([
                'name'          => 'required',
                'username'      => 'required',
                'email'         => 'required|unique:users,email',
                'password'      => 'min:6|required',
                'role'          => 'required',
                'photo'         => 'required|mimes:jpeg,png,jpg|max:2048'
            ], [
                'name.required'         => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'email.unique'          => 'Email sudah digunakan!',
                'password.required'     => 'Password harus diisi!',
                'password.min'          => 'Password minikal 6 karakter!',
                'role.required'         => 'Role harus diisi!',
                'photo.required'        => 'Foto harus diisi!',
                'photo.mimes'           => 'Format Foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
            ]);
            
            $file = $validateData['photo'];
            $fileName = date('mdYHis') . ' ' . $validateData['name'] . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);
            
            $user = new Users();
            $user->name          = $validateData['name'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            $user->password      = Hash::make($validateData['password']);
            $user->role          = $validateData['role'];
            $user->photo         = $fileName;
            $user->save();
    
            return redirect()->route('data-pengguna')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update(Request $request, $userId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->role) {
            $data = [
                'title'     => 'Data Pengguna',
                'subTitle'  => 'Edit',
                'detail'    => Users::find($userId),
                'user'      => Users::find(Session()->get('id')),
                'form'      => 'Edit',
            ];
            return view('user.form', $data);
        } else {
            $validateData = $request->validate([
                'name'          => 'required',
                'username'      => 'required',
                'email'         => 'required',
                'role'          => 'required',
                'photo'         => 'mimes:jpeg,png,jpg|max:2048'
            ], [
                'name.required'         => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'email.unique'          => 'Email sudah digunakan!',
                'role.required'         => 'Role harus diisi!',
                'photo.mimes'           => 'Format Foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
            ]);

            $user = Users::find($userId);
            $user->name          = $validateData['name'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            $user->role          = $validateData['role'];

            if ($request->password) {
                $user->password = Hash::make(Request()->password);
            }

            if ($request->photo) {
                if ($user->photo) {
                    unlink(public_path($this->public_path) . '/' . $user->photo);
                }

                $file = $request->photo;
                $fileName = date('mdYHis') . $request->name . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileName);
                $user->photo          = $fileName;
            }
            $user->save();

            $employee = Employees::where('id_user', $user->id)->first();
            $employee->full_name = $user->name;
            $employee->save();

            return redirect()->route('data-pengguna')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($userId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $user = Users::find($userId);
        $user->deleted_at = date('Y-m-d H:i:s');
        $user->save();

        return back()->with('success', 'Data berhasil dinonaktifkan!');
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
                'name'          => 'required',
                'username'      => 'required',
                'email'         => 'required',
                'photo'         => 'mimes:jpeg,png,jpg|max:2048'
            ], [
                'name.required'         => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'photo.mimes'           => 'Format foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
            ]);

            $user = Users::find($userId);
            $user->name          = $validateData['name'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            
            if ($request->photo) {
                if ($user->photo) {
                    unlink(public_path($this->public_path) . '/' . $user->photo);
                }

                $file = $request->photo;
                $fileName = date('mdYHis') . $request->name . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileName);
                $user->photo          = $fileName;
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

        if(!$request->old_password) {
            $data = [
                'title'     => 'Profil',
                'subTitle'  => 'Ubah Password',
                'user'      => Users::find(Session()->get('id'))
            ];
            return view('profil.changePassword', $data);
        } else {
            $validateData = $request->validate([
                'old_password'     => 'required|min:6',
                'new_password'     => 'required|min:6',
            ], [
                'old_password.required'    => 'Password Lama harus diisi!',
                'old_password.min'         => 'Password Lama minikal 6 karakter!',
                'new_password.required'    => 'Password Baru harus diisi!',
                'new_password.min'         => 'Password Lama minikal 6 karakter!',
            ]);
            
            $user = Users::find($userId);
            if (Hash::check($validateData['old_password'], $user->password)) {
                $user->password = Hash::make($validateData['new_password']);
                $user->save();
                return back()->with('success', 'Password berhasil diubah!');
            } else {
                return back()->with('failed', 'Password lama tidak sesuai.');
            }
        }
    }
}
