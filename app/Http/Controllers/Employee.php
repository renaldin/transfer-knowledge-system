<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Employees;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Employee extends Controller
{

    private $public_path;

    public function __construct()
    {
        $this->public_path = 'photo';
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Karyawan',
            'subTitle'          => 'Daftar',
            'user'              => Users::find(Session()->get('id')),
        ];

        if (Request()->keyword) {
            $keyword = Request()->keyword;
            $data['keyword']    = Request()->keyword;
            $data['employeeList'] =  Employees::with('user')->where('deleted_at', null)
                                    ->where(function($query) use ($keyword) {
                                        $query->where('full_name', 'like', '%'.$keyword.'%')
                                            ->orWhere('nik', 'like', '%'.$keyword.'%')
                                            ->orWhere('job_code', 'like', '%'.$keyword.'%')
                                            ->orWhere('job_title', 'like', '%'.$keyword.'%');
                                    })
                                    ->orderBy('created_at', 'DESC')
                                    ->limit(300)
                                    ->get();
        } else {
            $data['employeeList'] =  Employees::with('user')->where('deleted_at', null)->orderBy('created_at', 'DESC')->limit(300)->get();
            $data['keyword']    = null;
        }

        return view('employee.index', $data);
    }

    public function detail($employeeId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $data = [
            'title'             => 'Data Karyawan',
            'subTitle'          => 'Detail',
            'detail'            => Employees::with('user')->find($employeeId),
            'user'              => Users::find(Session()->get('id')),
            'form'              => 'Detail'
        ];

        return view('employee.form', $data);
    }

    public function new(Request $request)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->full_name) {
            $data = [
                'title'     => 'Data Karyawan',
                'subTitle'  => 'Tambah',
                'user'      => Users::find(Session()->get('id')),
                'form'      => 'Tambah',
            ];
            return view('employee.form', $data);
        } else {
            $validateData = $request->validate([
                'full_name'         => 'required',
                'username'          => 'required',
                'email'             => 'required|unique:users,email',
                'password'          => 'min:6|required',
                'role'              => 'required',
                'photo'             => 'required|mimes:jpeg,png,jpg|max:2048',
                'address'           => 'required',
                'birth_date'        => 'required',
                'nik'               => 'required|unique:employees,nik',
                'ogranization'      => 'required',
                'job_code'          => 'required',
                'job_title'         => 'required',
            ], [
                'full_name.required'    => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'email.unique'          => 'Email sudah digunakan!',
                'password.required'     => 'Password harus diisi!',
                'password.min'          => 'Password minikal 6 karakter!',
                'role.required'         => 'Role harus diisi!',
                'photo.required'        => 'Foto harus diisi!',
                'photo.mimes'           => 'Format Foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
                'address.required'      => 'Alamat harus diisi!',
                'birth_date.required'   => 'Tanggal lahir harus diisi!',
                'nik.required'          => 'NIK harus diisi!',
                'nik.unique'            => 'NIK sudah digunakan!',
                'organization.required' => 'Organisasi harus diisi!',
                'job_code.required'     => 'Kode pekerjaan harus diisi!',
                'job_title.required'    => 'Pekerjaan harus diisi!'
            ]);
            
            $file = $validateData['photo'];
            $fileName = date('mdYHis') . ' ' . $validateData['full_name'] . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);
            
            $user = new Users();
            $user->name          = $validateData['full_name'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            $user->password      = Hash::make($validateData['password']);
            $user->role          = $validateData['role'];
            $user->photo         = $fileName;
            $user->save();

            $userLatest = Users::latest()->first();
            $employee = new Employees();
            $employee->user_id      = $userLatest->id;
            $employee->full_name    = $validateData['full_name'];
            $employee->address      = $validateData['address'];
            $employee->birth_date   = $validateData['birth_date'];
            $employee->nik          = $validateData['nik'];
            $employee->organization = $validateData['organization'];
            $employee->job_code     = $validateData['job_code'];
            $employee->job_title    = $validateData['job_title'];
            $employee->save();
    
            return redirect()->route('data-karyawan')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update(Request $request, $employeeId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->full_name) {
            $data = [
                'title'     => 'Data Karyawan',
                'subTitle'  => 'Edit',
                'detail'    => Employees::with('user')->find($employeeId),
                'user'      => Users::find(Session()->get('id')),
                'form'      => 'Edit',
            ];
            return view('employee.form', $data);
        } else {
            $validateData = $request->validate([
                'full_name'         => 'required',
                'username'          => 'required',
                'email'             => 'required',
                'password'          => 'min:6|required',
                'role'              => 'required',
                'photo'             => 'mimes:jpeg,png,jpg|max:2048',
                'address'           => 'required',
                'birth_date'        => 'required',
                'nik'               => 'required',
                'ogranization'      => 'required',
                'job_code'          => 'required',
                'job_title'         => 'required',
            ], [
                'full_name.required'    => 'Nama lengkap harus diisi!',
                'username.required'     => 'Username harus diisi!',
                'email.required'        => 'Email harus diisi!',
                'password.required'     => 'Password harus diisi!',
                'password.min'          => 'Password minikal 6 karakter!',
                'role.required'         => 'Role harus diisi!',
                'photo.mimes'           => 'Format Foto harus jpg/jpeg/png!',
                'photo.max'             => 'Ukuran Foto maksimal 2 mb',
                'address.required'      => 'Alamat harus diisi!',
                'birth_date.required'   => 'Tanggal lahir harus diisi!',
                'nik.required'          => 'NIK harus diisi!',
                'organization.required' => 'Organisasi harus diisi!',
                'job_code.required'     => 'Kode pekerjaan harus diisi!',
                'job_title.required'    => 'Pekerjaan harus diisi!'
            ]);

            $employee = Employees::find($employeeId);
            $employee->user_id      = $employee->user_id;
            $employee->full_name    = $validateData['full_name'];
            $employee->address      = $validateData['address'];
            $employee->birth_date   = $validateData['birth_date'];
            $employee->nik          = $validateData['nik'];
            $employee->organization = $validateData['organization'];
            $employee->job_code     = $validateData['job_code'];
            $employee->job_title    = $validateData['job_title'];
            $employee->save();

            $user = Users::find($employee->user_id);
            $user->name          = $validateData['full_name'];
            $user->username      = $validateData['username'];
            $user->email         = $validateData['email'];
            $user->role          = $validateData['role'];

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            if ($request->photo) {
                if ($user->photo) {
                    unlink(public_path($this->public_path) . '/' . $user->photo);
                }

                $file = $request->photo;
                $fileName = date('mdYHis') . $request->full_name . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileName);
                $user->photo          = $fileName;
            }
            $user->save();

            return redirect()->route('data-karyawan')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($employeeId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $employee = Employees::find($employeeId);
        $employee->deleted_at = date('Y-m-d H:i:s');
        $employee->save();
        
        $user = Users::find($employee->user_id);
        $user->deleted_at = date('Y-m-d H:i:s');
        $user->save();

        return back()->with('success', 'Data berhasil dinonaktifkan!');
    }
}
