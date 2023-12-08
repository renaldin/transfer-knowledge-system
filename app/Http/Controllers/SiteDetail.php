<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSite;
use App\Models\ModelSiteDetail;
use App\Models\ModelUser;

class SiteDetail extends Controller
{

    private $ModelSite, $ModelUser, $ModelSiteDetail;

    public function __construct()
    {
        $this->ModelSite = new ModelSite();
        $this->ModelSiteDetail = new ModelSiteDetail();
        $this->ModelUser = new ModelUser();
    }

    public function index($id_site)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Detail Site',
            'subTitle'          => 'Daftar Detail Site',
            'detailSite'        => $this->ModelSite->findOne('id_site', $id_site),
            'daftarUser'        => $this->ModelUser->findAll('id_user', 'DESC'),
            'daftarSiteDetail'  => $this->ModelSiteDetail->findAll('id_site_detail', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('admin.siteDetail.index', $data);
    }

    public function new($id_site)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailSite = $this->ModelSiteDetail->check($id_site, Request()->id_user);

        if(!$detailSite) {
            $data = [
                'id_site'   => $id_site,
                'id_user'   => Request()->id_user
            ];
        } else {
            return back()->with('fail', 'Sales sudah ada dalam site!');
        }

        $this->ModelSiteDetail->create($data);
        return back()->with('success', 'Data berhasil ditambahkan!');

    }

    public function update($id_site_detail)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'id_site_detail'    => $id_site_detail,
            'id_site'           => Request()->id_site,
            'id_user'           => Request()->id_user
        ];
            
        $this->ModelSiteDetail->edit($data);
        return back()->with('success', 'Data berhasil diedit!');
    }

    public function delete($id_site_detail)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $this->ModelSiteDetail->deleteData('id_site_detail', $id_site_detail);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
