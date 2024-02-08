<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelNote;

class Note extends Controller
{

    private $ModelUser, $ModelNote;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelNote = new ModelNote();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Catatan',
            'subTitle'          => 'Daftar Catatan',
            'list'              => $this->ModelNote->findAll('id_note', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('note.index', $data);
    }

    public function detail($id_note)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Catatan',
            'subTitle'          => 'Detail Catatan',
            'detail'            => $this->ModelNote->findOne('id_note', $id_note),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            'form'              => 'Detail'
        ];

        return view('note.form', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->note_title) {
            $data = [
                'title'     => 'Data Catatan',
                'subTitle'  => 'Tambah Catatan',
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('note.form', $data);
        } else {
            Request()->validate([
                'note_title'    => 'required',
                'description'   => 'required',
                'start'         => 'required',
                'end'           => 'required',
                'location'      => 'required'
            ], [
                'note_title.required'   => 'Judul harus diisi!',
                'description.required'  => 'Deskripsi harus diisi!',
                'start.required'        => 'Tanggal mulai harus diisi!',
                'end.required'          => 'Tanggal akhir harus diisi!',
                'location.required'     => 'Lokasi harus diisi!'
            ]);

            $data = [
                'note_title'    => Request()->note_title,
                'start'         => Request()->start,
                'end'           => Request()->end,
                'description'   => Request()->description,
                'location'      => Request()->location,
                'id_user'       => Session()->get('id_user')
            ];
    
            $this->ModelNote->create($data);
            return redirect()->route('daftar-catatan')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_note)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->note_title) {
            $data = [
                'title'         => 'Data Catatan',
                'subTitle'      => 'Edit Catatan',
                'form'          => 'Edit',
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'detail'        => $this->ModelNote->findOne('id_note', $id_note)
            ];
            return view('note.form', $data);
        } else {
            Request()->validate([
                'note_title'    => 'required',
                'description'   => 'required',
                'start'         => 'required',
                'end'           => 'required',
                'location'      => 'required'
            ], [
                'note_title.required'   => 'Judul harus diisi!',
                'description.required'  => 'Deskripsi harus diisi!',
                'start.required'        => 'Tanggal mulai harus diisi!',
                'end.required'          => 'Tanggal akhir harus diisi!',
                'location.required'     => 'Lokasi harus diisi!'
            ]);

            $data = [
                'id_note'       => $id_note,
                'note_title'    => Request()->note_title,
                'start'         => Request()->start,
                'end'           => Request()->end,
                'description'   => Request()->description,
                'location'      => Request()->location,
                'id_user'       => Session()->get('id_user')
            ];
            
            $this->ModelNote->edit($data);
            return redirect()->route('daftar-catatan')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_note)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $this->ModelNote->deleteData('id_note', $id_note);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
