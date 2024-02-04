<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\Note;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NoteDataTable extends Controller
{

    private $ModelUser, $Note;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->Note = new Note();
    }

    public function data()
    {
        return DataTables::of($this->Note->findAll('id', 'DESC'))->toJson();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Note',
            'subTitle'          => 'Daftar Note',
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('noteDataTable.index', $data);
    }
}
