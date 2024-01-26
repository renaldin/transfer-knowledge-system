<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSite;
use App\Models\ModelStore;
use App\Models\ModelSiteDetail;
use App\Models\ModelUser;

class StoreAr extends Controller
{

    private $ModelSite, $ModelSiteDetail, $ModelUser, $ModelStore, $public_path_store, $public_path_ktp, $public_path_form;

    public function __construct()
    {
        $this->ModelSite = new ModelSite();
        $this->ModelSiteDetail = new ModelSiteDetail();
        $this->ModelUser = new ModelUser();
        $this->ModelStore = new ModelStore();
        $this->public_path_store = 'store';
        $this->public_path_ktp = 'store_ktp';
        $this->public_path_form = 'store_form';
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailSite = $this->ModelSiteDetail->siteUser(Session()->get('id_user'));
        $siteUser = [];
        foreach($detailSite as $item) {
            $siteUser[] = $item->id_site;
        }

        $data = [
            'title'             => 'Data Downline AR',
            'subTitle'          => 'Daftar Downline AR',
            'siteUser'          => $siteUser,
            'daftarStore'       => $this->ModelStore->findAll('id_store', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('storeAr.index', $data);
    }

    public function byId($id_store)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Downline AR',
            'subTitle'          => 'Detail Downline AR',
            'detail'            => $this->ModelStore->findOne('id_store', $id_store),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('storeAr.detail', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->store_name) {

            $detailSite = $this->ModelSiteDetail->siteUser(Session()->get('id_user'));
            $siteUser = [];
            foreach($detailSite as $item) {
                $siteUser[] = $item->id_site;
            }

            $data = [
                'title'         => 'Data Downline AR',
                'subTitle'      => 'Tambah Downline AR',
                'daftarUser'    => $this->ModelUser->findAll('id_user', 'ASC'),
                'daftarSiteAdmin'    => $this->ModelSite->findAll('id_site', 'ASC'),
                'daftarSite'    => $this->ModelSiteDetail->findAll('site_detail.id_site', 'ASC'),
                'siteUser'      => $this->ModelSiteDetail->siteUser(Session()->get('id_user')),
                'dataUser'      => $this->ModelSiteDetail->dataUser($siteUser),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'          => 'Tambah',
            ];
            return view('storeAr.form', $data);
        } else {
            Request()->validate([
                'id_site'               => 'required',
                'store_code'            => 'required',
                'store_name'            => 'required',
                'owner_name'            => 'required',
                'store_mobile_phone'    => 'required',
                'link_gmaps'            => 'required',
                'description'           => 'required',
                'store_pict'            => 'required|mimes:jpeg,png,jpg|max:2048',
                'ktp_pict'              => 'required|mimes:jpeg,png,jpg|max:2048',
                'form_pict'             => 'required|mimes:jpeg,png,jpg|max:2048',
            ], [
                'id_site.required'              => 'Nama site harus diisi!',
                'store_code.required'           => 'Kode downline harus diisi!',
                'store_name.required'           => 'Nama downline harus diisi!',
                'owner_name.required'           => 'Nama owner harus diisi!',
                'store_mobile_phone.required'   => 'Nomor telepon downline harus diisi!',
                'store_address.required'        => 'Alamat downline harus diisi!',
                'link_gmaps.required'           => 'Link google maps harus diisi!',
                'description.required'          => 'Deskripsi harus diisi!',
                'store_pict.required'           => 'Foto downline harus diisi!',
                'store_pict.mimes'              => 'Format foto downline harus jpg/jpeg/png!',
                'store_pict.max'                => 'Ukuran foto downline maksimal 2 mb',
                'ktp_pict.required'             => 'Foto KTP harus diisi!',
                'ktp_pict.mimes'                => 'Format foto KTP harus jpg/jpeg/png!',
                'ktp_pict.max'                  => 'Ukuran foto KTP maksimal 2 mb',
                'form_pict.required'            => 'Foto formulir harus diisi!',
                'form_pict.mimes'               => 'Format foto formulir harus jpg/jpeg/png!',
                'form_pict.max'                 => 'Ukuran foto formulir maksimal 2 mb',
            ]);

            $fileStorePict = Request()->store_pict;
            $fileNameStorePict = date('mdYHis') . ' ' . Request()->store_name . '.' . $fileStorePict->extension();
            $fileStorePict->move(public_path($this->public_path_store), $fileNameStorePict);

            $fileKtpPict = Request()->ktp_pict;
            $fileNameKtpPict = date('mdYHis') . ' ' . Request()->store_name . '.' . $fileKtpPict->extension();
            $fileKtpPict->move(public_path($this->public_path_ktp), $fileNameKtpPict);

            $fileFormPict = Request()->form_pict;
            $fileNameFormPict = date('mdYHis') . ' ' . Request()->store_name . '.' . $fileFormPict->extension();
            $fileFormPict->move(public_path($this->public_path_form), $fileNameFormPict);

            if(Session()->get('role') === 'Administrator' || Session()->get('role') === 'Admin Cabang') {
                $id_user = Request()->id_user;
            } else {
                $id_user = Session()->get('id_user');
            }

            $data = [
                'id_site'               => Request()->id_site,
                'id_user'               => $id_user,
                'store_code'            => Request()->store_code,
                'store_name'            => Request()->store_name,
                'owner_name'            => Request()->owner_name,
                'store_mobile_phone'    => Request()->store_mobile_phone,
                'store_address'         => Request()->store_address,
                'link_gmaps'            => Request()->link_gmaps,
                'description'           => Request()->description,
                'latitude'              => Request()->latitude,
                'longitude'             => Request()->longitude,
                'store_pict'            => $fileNameStorePict,
                'ktp_pict'              => $fileNameKtpPict,
                'form_pict'             => $fileNameFormPict,
            ];
    
            $this->ModelStore->create($data);
            return redirect()->route('daftar-store-ar')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_store)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->store_name) {
            $detailSite = $this->ModelSiteDetail->siteUser(Session()->get('id_user'));
            $siteUser = [];
            foreach($detailSite as $item) {
                $siteUser[] = $item->id_site;
            }

            $data = [
                'title'         => 'Data Downline AR',
                'subTitle'      => 'Edit Downline AR',
                'form'          => 'Edit',
                'daftarUser'    => $this->ModelUser->findAll('id_user', 'ASC'),
                'daftarSiteAdmin'    => $this->ModelSite->findAll('id_site', 'ASC'),
                'daftarSite'    => $this->ModelSiteDetail->findAll('site_detail.id_site', 'ASC'),
                'detail'        => $this->ModelStore->findOne('id_store', $id_store),
                'siteUser'      => $this->ModelSiteDetail->siteUser(Session()->get('id_user')),
                'dataUser'      => $this->ModelSiteDetail->dataUser($siteUser),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('storeAr.form', $data);
        } else {
            Request()->validate([
                'id_site'               => 'required',
                'store_code'            => 'required',
                'store_name'            => 'required',
                'owner_name'            => 'required',
                'store_mobile_phone'    => 'required',
                'link_gmaps'            => 'required',
                'description'           => 'required',
                'store_pict'            => 'mimes:jpeg,png,jpg|max:2048',
                'ktp_pict'              => 'mimes:jpeg,png,jpg|max:2048',
                'form_pict'             => 'mimes:jpeg,png,jpg|max:2048',
            ], [
                'id_site.required'              => 'Nama site harus diisi!',
                'store_code.required'           => 'Kode downline harus diisi!',
                'store_name.required'           => 'Nama downline harus diisi!',
                'owner_name.required'           => 'Nama owner harus diisi!',
                'store_mobile_phone.required'   => 'Nomor telepon downline harus diisi!',
                'store_address.required'        => 'Alamat downline harus diisi!',
                'link_gmaps.required'           => 'Link google maps harus diisi!',
                'description.required'          => 'Deskripsi harus diisi!',
                'store_pict.mimes'              => 'Format foto downline harus jpg/jpeg/png!',
                'store_pict.max'                => 'Ukuran foto downline maksimal 2 mb',
                'ktp_pict.mimes'                => 'Format foto KTP harus jpg/jpeg/png!',
                'ktp_pict.max'                  => 'Ukuran foto KTP maksimal 2 mb',
                'form_pict.mimes'               => 'Format foto formulir harus jpg/jpeg/png!',
                'form_pict.max'                 => 'Ukuran foto formulir maksimal 2 mb',
            ]);

            $store = $this->ModelStore->findOne('id_store', $id_store);

            if(Session()->get('role') === 'Administrator' || Session()->get('role') === 'Admin Cabang') {
                $id_user = Request()->id_user;
            } else {
                $id_user = Session()->get('id_user');
            }

            $data = [
                'id_store'              => $id_store,
                'id_site'               => Request()->id_site,
                'id_user'               => $id_user,
                'store_code'            => Request()->store_code,
                'store_name'            => Request()->store_name,
                'owner_name'            => Request()->owner_name,
                'store_mobile_phone'    => Request()->store_mobile_phone,
                'store_address'         => Request()->store_address,
                'link_gmaps'            => Request()->link_gmaps,
                'description'           => Request()->description,
                'latitude'              => Request()->latitude,
                'longitude'             => Request()->longitude
            ];

            if (Request()->store_pict <> "") {
                if ($store->store_pict <> "") {
                    unlink(public_path($this->public_path_store) . '/' . $store->store_pict);
                }

                $fileStorePict = Request()->store_pict;
                $fileNameStorePict = date('mdYHis') . ' ' . Request()->store_name . '.' . $fileStorePict->extension();
                $fileStorePict->move(public_path($this->public_path_store), $fileNameStorePict);

                $data['store_pict'] = $fileNameStorePict;
            }

            if (Request()->ktp_pict <> "") {
                if ($store->ktp_pict <> "") {
                    unlink(public_path($this->public_path_ktp) . '/' . $store->ktp_pict);
                }

                $fileKtpPict = Request()->ktp_pict;
                $fileNameKtpPict = date('mdYHis') . ' ' . Request()->store_name . '.' . $fileKtpPict->extension();
                $fileKtpPict->move(public_path($this->public_path_ktp), $fileNameKtpPict);

                $data['ktp_pict'] = $fileNameKtpPict;
            }

            if (Request()->form_pict <> "") {
                if ($store->form_pict <> "") {
                    unlink(public_path($this->public_path_form) . '/' . $store->form_pict);
                }

                $fileFormPict = Request()->form_pict;
                $fileNameFormPict = date('mdYHis') . ' ' . Request()->store_name . '.' . $fileFormPict->extension();
                $fileFormPict->move(public_path($this->public_path_form), $fileNameFormPict);

                $data['form_pict'] = $fileNameFormPict;
            }
            
            $this->ModelStore->edit($data);
            return redirect()->route('daftar-store-ar')->with('success', 'Data berhasil diedit!');
        }
    }

    public function updateStatus($id_store) 
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(Request()->store_status_ar) {
            $data = [
                'id_store'          => $id_store,
                'store_status_ar'   => Request()->store_status_ar
            ];
            $message = 'Status AR berhasil diubah!';
        } else {
            if(Request()->store_status) {
                $status_store = 1;
            } else {
                $status_store = 0;
            }
    
            $data = [
                'id_store'      => $id_store,
                'store_status'  => $status_store
            ];
            $message = 'Status berhasil diubah!';
        }

        $this->ModelStore->edit($data);
        return back()->with('success', $message);
    }

    public function delete($id_store)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $this->ModelStore->deleteData('id_store', $id_store);
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function downloadKtp($fileName) 
    {
        $path = public_path($this->public_path_ktp) .'/'. $fileName;

        return response()->download($path);
    }
}
