<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelInvoice;
use App\Models\ModelDetailInvoice;
use App\Models\ModelUser;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Invoice extends Controller
{

    private $ModelInvoice, $ModelDetailInvoice, $ModelUser;

    public function __construct()
    {
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelDetailInvoice = new ModelDetailInvoice();
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Invoice',
            'subTitle'          => 'Daftar Invoice',
            'daftarInvoice'     => $this->ModelInvoice->findAll('id_invoice', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('invoice.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $file = Request()->file('file_tambah_invoice');

        $spreadsheet = IOFactory::load($file->path());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        $dataInvoice = [
            'id_user'   => Session()->get('id_user'),
            'date'      => date('Y-m-d', strtotime(str_replace('/', '-', $data[3][3]))),
            'day'       => $data[1][3],
            'user_code_invoice' => $data[2][3]
        ];
        $this->ModelInvoice->create($dataInvoice);

        $lastDataInvoice = $this->ModelInvoice->lastData();

        $data = array_slice($data, 7, null, true);
        foreach ($data as $row) {
            $dataDetailInvoice = [
                'id_invoice'        => $lastDataInvoice->id_invoice,
                'store_code'        => $row[1],
                'store_name'        => $row[2],
                'bill'              => (int) str_replace('.', '', $row[3]),
                'limit'             => (int) str_replace('.', '', $row[4]),
                'group_price'       => $row[5],
                'activation_date'   => date('Y-d-m', strtotime($row[6]))
            ];
            $this->ModelDetailInvoice->create($dataDetailInvoice);
        };

        return back()->with('success', 'Data berhasil diimport!');
    }

    public function update($id_invoice)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->id_user) {
            $data = [
                'title'         => 'Data Invoice',
                'subTitle'      => 'Edit Invoice',
                'form'          => 'Edit',
                'daftarUser'    => $this->ModelUser->findAll('id_user', 'DESC'),
                'detail'        => $this->ModelInvoice->findOne('id_invoice', $id_invoice),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('invoice.form', $data);
        } else {

            if(Session()->get('role') === 'Administrator' || Session()->get('role') === 'Admin Cabang') {
                $id_user = Request()->id_user;
            } else {
                $id_user = Session()->get('id_user');
            }

            $data = [
                'id_invoice'    => $id_invoice,
                'id_user'       => $id_user,
                'date'          => Request()->date,
                'day'           => Request()->day,
                'user_code_invoice'     => Request()->user_code_invoice
            ];
            
            $this->ModelInvoice->edit($data);
            return redirect()->route('daftar-invoice')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_invoice)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $this->ModelInvoice->deleteData('id_invoice', $id_invoice);
        $this->ModelDetailInvoice->deleteData('id_invoice', $id_invoice);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
