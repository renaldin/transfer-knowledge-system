<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSite;
use App\Models\ModelTargetStore;
use App\Models\ModelSiteDetail;
use App\Models\ModelUser;

class TargetStore extends Controller
{

    private $ModelSite, $ModelSiteDetail, $ModelUser, $ModelTargetStore, $public_path, $public_path_ktp, $public_path_form;

    public function __construct()
    {
        $this->ModelSite = new ModelSite();
        $this->ModelSiteDetail = new ModelSiteDetail();
        $this->ModelUser = new ModelUser();
        $this->ModelTargetStore = new ModelTargetStore();
        $this->public_path = 'target_store';
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
            'title'             => 'Data Target Store',
            'subTitle'          => 'Daftar Target Store',
            'siteUser'          => $siteUser,
            'daftarTargetStore' => $this->ModelTargetStore->findAll('id_target_store', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('targetStore.index', $data);
    }

    public function byId($id_target_store)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Target Store',
            'subTitle'          => 'Detail Target Store',
            'detail'            => $this->ModelTargetStore->findOne('id_target_store', $id_target_store),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('targetStore.detail', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->target_store_name) {

            $detailSite = $this->ModelSiteDetail->siteUser(Session()->get('id_user'));
            $siteUser = [];
            foreach($detailSite as $item) {
                $siteUser[] = $item->id_site;
            }

            $data = [
                'title'             => 'Data Target Store',
                'subTitle'          => 'Tambah Target Store',
                'daftarUser'        => $this->ModelUser->findAll('id_user', 'ASC'),
                'daftarSiteAdmin'   => $this->ModelSite->findAll('id_site', 'ASC'),
                'daftarSite'        => $this->ModelSiteDetail->findAll('site_detail.id_site', 'ASC'),
                'siteUser'          => $this->ModelSiteDetail->siteUser(Session()->get('id_user')),
                'dataUser'          => $this->ModelSiteDetail->dataUser($siteUser),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'              => 'Tambah',
            ];
            return view('targetStore.form', $data);
        } else {
            $this->validation('New');

            $fileTargetStorePict = Request()->target_store_pict;
            $fileNameTargetStorePict = date('mdYHis') . ' ' . Request()->target_store_name . '.' . $fileTargetStorePict->extension();
            $fileTargetStorePict->move(public_path($this->public_path), $fileNameTargetStorePict);

            if(Session()->get('role') === 'Administrator' || Session()->get('role') === 'Admin Cabang') {
                $id_user = Request()->id_user;
            } else {
                $id_user = Session()->get('id_user');
            }

            $data = [
                'id_site'               => Request()->id_site,
                'id_user'               => $id_user,
                'target_store_name'     => Request()->target_store_name,
                'target_store_owner'    => Request()->target_store_owner,
                'target_store_mobile'   => Request()->target_store_mobile,
                'target_store_address'  => Request()->target_store_address,
                'reschedule_date'       => Request()->reschedule_date,
                'target_store_status'   => Request()->target_store_status,
                'description'           => Request()->description,
                'target_store_pict'     => $fileNameTargetStorePict,
            ];
    
            $this->ModelTargetStore->create($data);
            return redirect()->route('daftar-target-store')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_target_store)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->target_store_name) {
            $detailSite = $this->ModelSiteDetail->siteUser(Session()->get('id_user'));
            $siteUser = [];
            foreach($detailSite as $item) {
                $siteUser[] = $item->id_site;
            }

            $data = [
                'title'             => 'Data Target Store',
                'subTitle'          => 'Edit Target Store',
                'form'              => 'Edit',
                'daftarUser'        => $this->ModelUser->findAll('id_user', 'ASC'),
                'daftarSiteAdmin'   => $this->ModelSite->findAll('id_site', 'ASC'),
                'daftarSite'        => $this->ModelSiteDetail->findAll('site_detail.id_site', 'ASC'),
                'detail'            => $this->ModelTargetStore->findOne('id_target_store', $id_target_store),
                'siteUser'          => $this->ModelSiteDetail->siteUser(Session()->get('id_user')),
                'dataUser'          => $this->ModelSiteDetail->dataUser($siteUser),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('targetStore.form', $data);
        } else {
            $this->validation('Update');

            $targetStore = $this->ModelTargetStore->findOne('id_target_store', $id_target_store);

            if(Session()->get('role') === 'Administrator' || Session()->get('role') === 'Admin Cabang') {
                $id_user = Request()->id_user;
            } else {
                $id_user = Session()->get('id_user');
            }

            $data = [
                'id_target_store'       => $id_target_store,
                'id_site'               => Request()->id_site,
                'id_user'               => $id_user,
                'target_store_name'     => Request()->target_store_name,
                'target_store_owner'    => Request()->target_store_owner,
                'target_store_mobile'   => Request()->target_store_mobile,
                'target_store_address'  => Request()->target_store_address,
                'reschedule_date'       => Request()->reschedule_date,
                'target_store_status'   => Request()->target_store_status,
                'description'           => Request()->description
            ];

            if (Request()->target_store_pict <> "") {
                if ($targetStore->target_store_pict <> "") {
                    unlink(public_path($this->public_path) . '/' . $targetStore->target_store_pict);
                }

                $fileTargetStorePict = Request()->target_store_pict;
                $fileNameTargetStorePict = date('mdYHis') . ' ' . Request()->target_store_name . '.' . $fileTargetStorePict->extension();
                $fileTargetStorePict->move(public_path($this->public_path), $fileNameTargetStorePict);

                $data['target_store_pict'] = $fileNameTargetStorePict;
            }
            
            $this->ModelTargetStore->edit($data);
            return redirect()->route('daftar-target-store')->with('success', 'Data berhasil diedit!');
        }
    }

    public function updateStatus($id_target_store) 
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $targetStore = $this->ModelTargetStore->findOne('id_target_store', $id_target_store);

        if ($targetStore->target_store_pict <> "") {
            unlink(public_path($this->public_path) . '/' . $targetStore->target_store_pict);
        }

        $data = [
            'id_target_store'      => $id_target_store,
            'target_store_status'  => Request()->target_store_status
        ];

        $this->ModelTargetStore->edit($data);
        return back()->with('success', 'Status berhasil diubah!');
    }

    public function delete($id_target_store)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $this->ModelTargetStore->deleteData('id_target_store', $id_target_store);
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function validation($type)
    {
        if ($type === 'New') {
            $validate = Request()->validate([
                            'target_store_name'     => 'required',
                            'target_store_owner'    => 'required',
                            'target_store_mobile'   => 'required',
                            'target_store_address'  => 'required',
                            'reschedule_date'       => 'required',
                            'description'           => 'required',
                            'target_store_status'   => 'required',
                            'target_store_pict'     => 'required|mimes:jpeg,png,jpg|max:2048'
                        ], [
                            'target_store_name.required'        => 'Nama Store harus diisi!',
                            'target_store_owner.required'       => 'Owner harus diisi!',
                            'target_store_mobile.required'      => 'Nomor telepon harus diisi!',
                            'target_store_address.required'     => 'Alamat store harus diisi!',
                            'reschedule_date.required'          => 'Tanggal harus diisi!',
                            'description.required'              => 'Deskripsi harus diisi!',
                            'target_store_status.required'      => 'Status target store harus diisi!',
                            'target_store_pict.required'        => 'Foto store harus diisi!',
                            'target_store_pict.mimes'           => 'Format foto store harus jpg/jpeg/png!',
                            'target_store_pict.max'             => 'Ukuran foto store maksimal 2 mb',
                        ]);
        } elseif($type === 'Update') {
            $validate = Request()->validate([
                        'target_store_name'     => 'required',
                        'target_store_owner'    => 'required',
                        'target_store_mobile'   => 'required',
                        'target_store_address'  => 'required',
                        'reschedule_date'       => 'required',
                        'description'           => 'required',
                        'target_store_status'   => 'required',
                        'target_store_pict'     => 'mimes:jpeg,png,jpg|max:2048'
                    ], [
                        'target_store_name.required'        => 'Nama Store harus diisi!',
                        'target_store_owner.required'       => 'Owner harus diisi!',
                        'target_store_mobile.required'      => 'Nomor telepon harus diisi!',
                        'target_store_address.required'     => 'Alamat store harus diisi!',
                        'reschedule_date.required'          => 'Tanggal harus diisi!',
                        'description.required'              => 'Deskripsi harus diisi!',
                        'target_store_status.required'      => 'Status target store harus diisi!',
                        'target_store_pict.mimes'           => 'Format foto store harus jpg/jpeg/png!',
                        'target_store_pict.max'             => 'Ukuran foto store maksimal 2 mb',
                    ]);
        }

        return $validate;
    }
}
