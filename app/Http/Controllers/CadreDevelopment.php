<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Employees;
use App\Models\CadreDevelopments;
use Illuminate\Http\Request;

class CadreDevelopment extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Kaderisasi',
            'subTitle'          => 'Daftar',
            'user'              => Users::find(Session()->get('id')),
        ];

        if (Request()->keyword) {
            $keyword = Request()->keyword;
            $data['keyword']    = Request()->keyword;
            $data['cadreDevelopmentList'] =  CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')
            ->where('cadre_developments.deleted_at', null)
            ->where(function($query) use ($keyword) {
                $query->whereHas('juniorEmployee', function($q) use ($keyword) {
                    $q->where('full_name', 'like', '%'.$keyword.'%');
                })
                ->orWhereHas('manager', function($q) use ($keyword) {
                    $q->where('full_name', 'like', '%'.$keyword.'%');
                })
                ->orWhereHas('seniorEmployee', function($q) use ($keyword) {
                    $q->where('full_name', 'like', '%'.$keyword.'%');
                });
            })
            ->orderBy('cadre_developments.created_at', 'DESC')
            ->limit(300)
            ->get();
        } else {
            $data['cadreDevelopmentList'] =  CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')->where('deleted_at', null)->orderBy('created_at', 'DESC')->limit(300)->get();
            $data['keyword']    = null;
        }
        
        return view('cadreDevelopment.index', $data);
    }

    public function detail($cadreDevelopmentId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $data = [
            'title'             => 'Data Kaderisasi',
            'subTitle'          => 'Detail',
            'juniorEmployee'    => Employees::with('user')->whereHas('user', function($query) {
                                        $query->where('role', 'Karyawan Junior')
                                        ->where('deleted_at', null);
                                    })->get(),
            'seniorEmployee'    => Employees::with('user')->whereHas('user', function($query) {
                                        $query->where('role', 'Karyawan Senior')
                                        ->where('deleted_at', null);
                                    })->get(),
            'manager'           => Employees::with('user')->whereHas('user', function($query) {
                                        $query->where('role', 'Manager')
                                        ->where('deleted_at', null);
                                    })->get(),
            'detail'            => CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')->find($cadreDevelopmentId),
            'user'              => Users::find(Session()->get('id')),
            'form'              => 'Detail'
        ];

        return view('cadreDevelopment.detail', $data);
    }

    public function new(Request $request)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->junior_employee_id) {
            $data = [
                'title'             => 'Data Kaderisasi',
                'subTitle'          => 'Tambah',
                'juniorEmployee'    => Employees::with('user')->whereHas('user', function($query) {
                                            $query->where('role', 'Karyawan Junior')
                                            ->where('deleted_at', null);
                                        })->get(),
                'seniorEmployee'    => Employees::with('user')->whereHas('user', function($query) {
                                            $query->where('role', 'Karyawan Senior')
                                            ->where('deleted_at', null);
                                        })->get(),
                'manager'           => Employees::with('user')->whereHas('user', function($query) {
                                            $query->where('role', 'Manager')
                                            ->where('deleted_at', null);
                                        })->get(),
                'user'              => Users::find(Session()->get('id')),
                'form'              => 'Tambah',
            ];
            return view('cadreDevelopment.form', $data);
        } else {
            $request->validate([
                'junior_employee_id'    => 'required',
                'senior_employee_id'    => 'required',
                'manager_id'            => 'required',
                'description'           => 'required'
            ], [
                'junior_employee_id.required'   => 'Karyawan junior harus diisi!',
                'senior_employee_id.required'   => 'Karyawan senior harus diisi!',
                'manager_id.required'           => 'Manager harus diisi!',
                'description.required'          => 'Uraian keilmuan harus diisi!'
            ]);

            $checkCadre = CadreDevelopments::where('deleted_at', null)->where('junior_employee_id', $request->junior_employee_id)->where('senior_employee_id', $request->senior_employee_id)->first();
            if ($checkCadre) {
                return redirect()->route('data-kaderisasi')->with('failed', 'Gagal! Kaderisasi sudah ada!');
            }
            
            $cadreDevlopment = new CadreDevelopments();
            $cadreDevlopment->junior_employee_id    = $request->junior_employee_id;
            $cadreDevlopment->senior_employee_id    = $request->senior_employee_id;
            $cadreDevlopment->manager_id            = $request->manager_id;
            $cadreDevlopment->admin_corporate_id    = Session()->get('id');
            $cadreDevlopment->description           = $request->description;
            $cadreDevlopment->save();
    
            return redirect()->route('data-kaderisasi')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update(Request $request, $cadreDevelopmentId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->manager_id) {
            $data = [
                'title'             => 'Data Kaderisasi',
                'subTitle'          => 'Edit',
                'juniorEmployee'    => Employees::with('user')->whereHas('user', function($query) {
                                            $query->where('role', 'Karyawan Junior')
                                            ->where('deleted_at', null);
                                        })->get(),
                'seniorEmployee'    => Employees::with('user')->whereHas('user', function($query) {
                                            $query->where('role', 'Karyawan Senior')
                                            ->where('deleted_at', null);
                                        })->get(),
                'manager'           => Employees::with('user')->whereHas('user', function($query) {
                                            $query->where('role', 'Manager')
                                            ->where('deleted_at', null);
                                        })->get(),
                'detail'            => CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')->find($cadreDevelopmentId),
                'user'              => Users::find(Session()->get('id')),
                'form'              => 'Edit',
            ];
            return view('cadreDevelopment.form', $data);
        } else {
            $request->validate([
                'manager_id'            => 'required',
                'description'           => 'required'
            ], [
                'manager_id.required'           => 'Manager harus diisi!',
                'description.required'          => 'Uraian keilmuan harus diisi!'
            ]);
            
            $cadreDevlopment = CadreDevelopments::find($cadreDevelopmentId);
            // $cadreDevlopment->junior_employee_id    = $request->junior_employee_id;
            // $cadreDevlopment->senior_employee_id    = $request->senior_employee_id;
            $cadreDevlopment->manager_id            = $request->manager_id;
            $cadreDevlopment->admin_corporate_id    = Session()->get('id');
            $cadreDevlopment->description           = $request->description;
            $cadreDevlopment->save();

            return redirect()->route('data-kaderisasi')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($cadreDevelopmentId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $cadreDevlopment = CadreDevelopments::find($cadreDevelopmentId);
        $cadreDevlopment->deleted_at = date('Y-m-d H:i:s');
        $cadreDevlopment->save();

        return back()->with('success', 'Data berhasil dinonaktifkan!');
    }
}
