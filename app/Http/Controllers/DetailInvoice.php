<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelInvoice;
use App\Models\ModelDetailInvoice;
use App\Models\ModelUser;
use App\Models\ModelStore;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DetailInvoice extends Controller
{

    private $ModelInvoice, $ModelDetailInvoice, $ModelUser, $ModelStore;

    public function __construct()
    {
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelDetailInvoice = new ModelDetailInvoice();
        $this->ModelUser = new ModelUser();
        $this->ModelStore = new ModelStore();
    }

    public function index($id_invoice)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Invoice',
            'subTitle'          => 'Daftar Detail Invoice',
            'invoice'           => $this->ModelInvoice->findOne('id_invoice', $id_invoice),
            'daftarDetailInvoice'     => $this->ModelDetailInvoice->findAll('id_detail_invoice', 'ASC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('detailInvoice.index', $data);
    }

    public function update($id_detail_invoice)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailInvoice = $this->ModelDetailInvoice->findOne('id_detail_invoice', $id_detail_invoice);
        $detailStore = $this->ModelStore->findOne('store_code', $detailInvoice->store_code);

        if(!Request()->add) {
            $data = [
                'title'         => 'Data Invoice',
                'subTitle'      => 'Edit Detail Invoice',
                'form'          => 'Edit',
                'detailStore'   => $detailStore,
                'detail'        => $detailInvoice,
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('detailInvoice.form', $data);
        } else {
            $data = [
                'id_detail_invoice'     => $id_detail_invoice,
                'add'                   => (int) str_replace('.', '', Request()->add),
                'remaining_balance'     => (int) str_replace('.', '', Request()->remaining_balance),
                'notes'                 => Request()->notes,
                'visit'                 => Request()->visit,
                'absensi'               => Request()->absensi,
                'notes_for_salesman'    => Request()->notes_for_salesman,
            ];
            
            $this->ModelDetailInvoice->edit($data);
            return redirect()->to('/detail-invoice/'.Request()->id_invoice)->with('success', 'Data berhasil diedit!');
        }
    }
}
