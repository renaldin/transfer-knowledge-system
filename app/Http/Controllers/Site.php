<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSite;
use App\Models\ModelSiteDetail;
use App\Models\ModelUser;

class Site extends Controller
{

    private $ModelSite, $ModelSiteDetail, $ModelUser;

    public function __construct()
    {
        $this->ModelSite = new ModelSite();
        $this->ModelSiteDetail = new ModelSiteDetail();
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Cluster',
            'subTitle'          => 'Daftar Cluster',
            'daftarSite'        => $this->ModelSite->findAll('id_site', 'DESC'),
            'siteUser'          => $this->ModelSiteDetail->siteUser(Session()->get('id_user')),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('admin.site.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->site_name) {
            $data = [
                'title'     => 'Data Cluster',
                'subTitle'  => 'Tambah Cluster',
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('admin.site.form', $data);
        } else {
            Request()->validate([
                'site_name'     => 'required',
                'site_address'  => 'required'
            ], [
                'site_name.required'    => 'Nama site harus diisi!',
                'site_address.required' => 'Alamat site harus diisi!'
            ]);

            $data = [
                'site_name'     => Request()->site_name,
                'site_address'  => Request()->site_address
            ];
            $this->ModelSite->create($data);

            $lastSite = $this->ModelSite->lastData('id_site', 'DESC');

            if(Session()->get('role') === 'Admin Cabang') {
                $dataSiteDetail = [
                    'id_user'   => Session()->get('id_user'),
                    'id_site'   => $lastSite->id_site
                ];
                $this->ModelSiteDetail->create($dataSiteDetail);
            }
            return redirect()->route('daftar-site')->with('success', 'Data berhasil ditambahkan!');
        }

    }

    public function update($id_site)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->site_name) {
            $data = [
                'title'         => 'Data Cluster',
                'subTitle'      => 'Edit Cluster',
                'form'          => 'Edit',
                'detail'        => $this->ModelSite->findOne('id_site', $id_site),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('admin.site.form', $data);
        } else {
            Request()->validate([
                'site_name'     => 'required',
                'site_address'  => 'required'
            ], [
                'site_name.required'    => 'Nama site harus diisi!',
                'site_address.required' => 'Alamat site harus diisi!'
            ]);

            $data = [
                'id_site'       => $id_site,
                'site_name'     => Request()->site_name,
                'site_address'  => Request()->site_address
            ];
            
            $this->ModelSite->edit($data);
            return redirect()->route('daftar-site')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_site)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        if(Session()->get('role') === 'Admin Cabang') {
            $this->ModelSiteDetail->deleteDataUser(Session()->get('id_user'), $id_site);
        } else {
            $this->ModelSite->deleteData('id_site', $id_site);
            $this->ModelSiteDetail->deleteData('id_site', $id_site);
        }
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
