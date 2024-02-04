<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use Illuminate\Support\Facades\Hash;

class Klien extends Controller
{

    private $ModelUser, $public_path;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->public_path = 'photo';
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Klien',
            'subTitle'          => 'Daftar Klien',
            'daftarKlien'       => $this->ModelUser->findAllWhere('id_user', 'DESC', 'role', 'Klien'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('klien.index', $data);
    }

    public function detail($id_user)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Klien',
            'subTitle'          => 'Detail Klien',
            'detail'            => $this->ModelUser->findOne('id_user', $id_user),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            'form'              => 'Detail'
        ];

        return view('klien.form', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->fullname) {
            $data = [
                'title'     => 'Data Klien',
                'subTitle'  => 'Tambah Klien',
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('klien.form', $data);
        } else {
            Request()->validate([
                'fullname'      => 'required',
                'username'      => 'required',
                'email'         => 'required|unique:user,email',
                'password'      => 'min:6|required',
                'user_address'  => 'required',
                'mobile_phone'  => 'required',
                'photo'         => 'required|mimes:jpeg,png,jpg|max:2048'
            ], [
                'fullname.required'     => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'email.unique'          => 'Email sudah digunakan!',
                'password.required'     => 'Password harus diisi!',
                'password.min'          => 'Password minikal 6 karakter!',
                'user_address.required' => 'Alamat harus diisi!',
                'mobile_phone.required' => 'Nomor telepon harus diisi!',
                'photo.required'        => 'Foto harus diisi!',
                'photo.mimes'           => 'Format Foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
            ]);

            $file = Request()->photo;
            $fileName = date('mdYHis') . ' ' . Request()->fullname . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);

            $data = [
                'fullname'      => Request()->fullname,
                'username'      => Request()->username,
                'email'         => Request()->email,
                'password'      => Hash::make(Request()->password),
                'user_address'  => Request()->user_address,
                'mobile_phone'  => Request()->mobile_phone,
                'role'          => 'Klien',
                'photo'         => $fileName
            ];
    
            $this->ModelUser->create($data);
            return redirect()->route('daftar-klien')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_user)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->fullname) {
            $data = [
                'title'         => 'Data Klien',
                'subTitle'      => 'Edit Klien',
                'form'          => 'Edit',
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'detail'        => $this->ModelUser->findOne('id_user', $id_user)
            ];
            return view('klien.form', $data);
        } else {
            Request()->validate([
                'fullname'      => 'required',
                'username'      => 'required',
                'email'         => 'required',
                'user_address'  => 'required',
                'mobile_phone'  => 'required',
                'photo'         => 'mimes:jpeg,png,jpg|max:2048'
            ], [
                'fullname.required'     => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'user_address.required' => 'Alamat harus diisi!',
                'mobile_phone.required' => 'Nomor telepon harus diisi!',
                'photo.mimes'           => 'Format Foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
            ]);

            $user = $this->ModelUser->findOne('id_user', $id_user);

            $data = [
                'id_user'       => $id_user,
                'fullname'      => Request()->fullname,
                'username'      => Request()->username,
                'email'         => Request()->email,
                'user_address'  => Request()->user_address,
                'mobile_phone'  => Request()->mobile_phone,
                'role'          => 'Klien'
            ];

            if (Request()->password) {
                $data['password'] = Hash::make(Request()->password);
            }

            if (Request()->photo <> "") {
                if ($user->photo <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->photo);
                }

                $file = Request()->photo;
                $fileName = date('mdYHis') . Request()->fullname . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileName);

                $data['photo'] = $fileName;
            }
            
            $this->ModelUser->edit($data);
            return redirect()->route('daftar-klien')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_user)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $user = $this->ModelUser->findOne('id_user', $id_user);

        if ($user->photo <> "") {
            unlink(public_path($this->public_path) . '/' . $user->photo);
        }

        $this->ModelUser->deleteData('id_user', $id_user);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
