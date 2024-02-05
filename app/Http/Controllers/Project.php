<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelProject;

class Project extends Controller
{

    private $ModelUser, $ModelProject;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelProject = new ModelProject();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Proyek',
            'subTitle'          => 'Daftar Proyek',
            'list'              => $this->ModelProject->findAll('id_project', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('project.index', $data);
    }

    public function detail($id_project)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Proyek',
            'subTitle'          => 'Detail Proyek',
            'klienList'         => $this->ModelUser->findAllWhere('id_user', 'DESC', 'role', 'Klien'), 
            'detail'            => $this->ModelProject->findOne('id_project', $id_project),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            'form'              => 'Detail'
        ];

        return view('project.form', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->project_title) {
            $data = [
                'title'     => 'Data Proyek',
                'subTitle'  => 'Tambah Proyek',
                'klienList' => $this->ModelUser->findAllWhere('id_user', 'DESC', 'role', 'Klien'), 
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('project.form', $data);
        } else {
            Request()->validate([
                'id_user'       => 'required',
                'project_title' => 'required',
                'start_date'    => 'required',
                'deadline'      => 'required',
                'dp'            => 'required',
                'project_type'  => 'required'
            ], [
                'id_user.required'      => 'Klien harus diisi!',
                'project_title.required'=> 'Judul proyek harus diisi!',
                'start_date.required'   => 'Tanggal mulai harus diisi!',
                'deadline.required'     => 'Deadline harus diisi!',
                'dp.required'           => 'DP harus diisi!',
                'project_type.required' => 'Jenis proyek harus diisi!'
            ]);

            $data = [
                'id_user'           => Request()->id_user,
                'project_title'     => Request()->project_title,
                'start_date'        => Request()->start_date,
                'deadline'          => Request()->deadline,
                'dp'                => (int) str_replace('.', '', Request()->dp),
                'project_type'      => Request()->project_type,
                'project_status'    => Request()->project_status,
                'document_status'   => Request()->document_status,
                'project_note'      => Request()->project_note
            ];
    
            $this->ModelProject->create($data);
            return redirect()->route('daftar-proyek')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_project)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->project_title) {
            $data = [
                'title'         => 'Data Proyek',
                'subTitle'      => 'Edit Proyek',
                'form'          => 'Edit',
                'klienList'     => $this->ModelUser->findAllWhere('id_user', 'DESC', 'role', 'Klien'), 
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'detail'        => $this->ModelProject->findOne('id_project', $id_project)
            ];
            return view('project.form', $data);
        } else {
            Request()->validate([
                'id_user'       => 'required',
                'project_title' => 'required',
                'start_date'    => 'required',
                'deadline'      => 'required',
                'dp'            => 'required',
                'project_type'  => 'required'
            ], [
                'id_user.required'      => 'Klien harus diisi!',
                'project_title.required'=> 'Judul proyek harus diisi!',
                'start_date.required'   => 'Tanggal mulai harus diisi!',
                'deadline.required'     => 'Deadline harus diisi!',
                'dp.required'           => 'DP harus diisi!',
                'project_type.required' => 'Jenis proyek harus diisi!'
            ]);

            $project = $this->ModelProject->findOne('id_project', $id_project);

            $data = [
                'id_project'        => $id_project,
                'id_user'           => Request()->id_user,
                'project_title'     => Request()->project_title,
                'start_date'        => Request()->start_date,
                'deadline'          => Request()->deadline,
                'dp'                => (int) str_replace('.', '', Request()->dp),
                'project_type'      => Request()->project_type,
                'project_status'    => Request()->project_status,
                'document_status'   => Request()->document_status,
                'project_note'      => Request()->project_note
            ];
            
            $this->ModelProject->edit($data);
            return redirect()->route('daftar-proyek')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_project)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $this->ModelProject->deleteData('id_project', $id_project);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
