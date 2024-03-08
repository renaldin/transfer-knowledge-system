<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\CadreDevelopments;
use App\Models\Assignments;
use Illuminate\Http\Request;

class Assignment extends Controller
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
            'title'             => 'Data Penugasan',
            'subTitle'          => 'Daftar',
            'user'              => Users::find(Session()->get('id')),
        ];

        if (Request()->keyword) {
            $keyword = Request()->keyword;
            $data['keyword']    = Request()->keyword;
            $data['assignmentList'] =  Assignments::with('cadreDevelopment', 'manager')
            ->where('deleted_at', null)
            ->where(function($query) use ($keyword) {
                $query->whereHas('cadreDevelopment', function($q) use ($keyword) {
                    $q->where('juniorEmployee.full_name', 'like', '%'.$keyword.'%');
                })
                ->orWhereHas('manager', function($q) use ($keyword) {
                    $q->where('full_name', 'like', '%'.$keyword.'%');
                })
                ->orWhereHas('cadreDevelopment', function($q) use ($keyword) {
                    $q->where('seniorEmployee.full_name', 'like', '%'.$keyword.'%');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->limit(300)
            ->get();
        } else {
            $data['assignmentList'] =  Assignments::with('cadreDevelopment', 'manager')->where('deleted_at', null)->orderBy('created_at', 'DESC')->limit(300)->get();
            $data['keyword']    = null;
        }
        
        return view('assignment.index', $data);
    }

    public function detail($assignmentId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $data = [
            'title'             => 'Data Penugasan',
            'subTitle'          => 'Detail',
            'cadreDevelopment'  => CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')->where('deleted_at', null)->orderBy('created_at', 'DESC')->get(),
            'detail'            => Assignments::with('cadreDevelopment', 'manager')->find($assignmentId),
            'user'              => Users::find(Session()->get('id')),
            'form'              => 'Detail'
        ];

        return view('assignment.form', $data);
    }

    public function new(Request $request)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->task) {
            $data = [
                'title'             => 'Data Penugasan',
                'subTitle'          => 'Tambah',
                'cadreDevelopment'  => CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')->where('deleted_at', null)->orderBy('created_at', 'DESC')->get(),
                'user'              => Users::find(Session()->get('id')),
                'form'              => 'Tambah',
            ];
            return view('assignment.form', $data);
        } else {
            $request->validate([
                'cadre_development_id'  => 'required',
                'task'                  => 'required',
                'start_date'            => 'required',
                'last_date'             => 'required',
                'description'           => 'required'
            ], [
                'cadre_development_id.required' => 'Kaderisasi harus diisi!',
                'task.required'                 => 'Tugas harus diisi!',
                'start_date.required'           => 'Tanggal mulai harus diisi!',
                'last_date.required'            => 'Tanggal akhir harus diisi!',
                'description.required'          => 'Uraian penugasan harus diisi!'
            ]);
            
            $assignment = new Assignments();
            $assignment->cadre_development_id   = $request->cadre_development_id;
            $assignment->task                   = $request->task;
            $assignment->start_date             = $request->start_date;
            $assignment->last_date              = $request->last_date;
            $assignment->description            = $request->description;
            $assignment->task_status            = 'BELUM';
            $assignment->manager_id             = Session()->get('id');
            $assignment->save();
    
            return redirect()->route('data-penugasan')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update(Request $request, $assignmentId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!$request->task) {
            $data = [
                'title'             => 'Data Penugasan',
                'subTitle'          => 'Edit',
                'cadreDevelopment'  => CadreDevelopments::with('juniorEmployee', 'seniorEmployee', 'adminCorporate', 'manager')->where('deleted_at', null)->orderBy('created_at', 'DESC')->get(),
                'detail'            => Assignments::with('cadreDevelopment', 'manager')->find($assignmentId),
                'user'              => Users::find(Session()->get('id')),
                'form'              => 'Edit',
            ];
            return view('assignment.form', $data);
        } else {
            $request->validate([
                'task'                  => 'required',
                'start_date'            => 'required',
                'last_date'             => 'required',
                'description'           => 'required'
            ], [
                'task.required'                 => 'Tugas harus diisi!',
                'start_date.required'           => 'Tanggal mulai harus diisi!',
                'last_date.required'            => 'Tanggal akhir harus diisi!',
                'description.required'          => 'Uraian penugasan harus diisi!'
            ]);
            
            $assignment = Assignments::find($assignmentId);
            // $assignment->cadre_development_id   = $request->cadre_development_id;
            $assignment->task                   = $request->task;
            $assignment->start_date             = $request->start_date;
            $assignment->last_date              = $request->last_date;
            $assignment->description            = $request->description;
            $assignment->manager_id             = Session()->get('id');
            $assignment->save();

            return redirect()->route('data-penugasan')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($assignmentId)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $assignment = Assignments::find($assignmentId);
        $assignment->deleted_at = date('Y-m-d H:i:s');
        $assignment->save();

        return back()->with('success', 'Data berhasil dinonaktifkan!');
    }
}
