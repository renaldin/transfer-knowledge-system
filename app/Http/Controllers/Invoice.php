<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelInvoice;
use App\Models\ModelDetailInvoice;
use App\Models\ModelUser;
use App\Models\ModelStore;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Invoice extends Controller
{

    private $ModelInvoice, $ModelDetailInvoice, $ModelUser, $ModelStore;

    public function __construct()
    {
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelDetailInvoice = new ModelDetailInvoice();
        $this->ModelUser = new ModelUser();
        $this->ModelStore = new ModelStore();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->filter_by) {
            $data = [
                'title'             => 'Data Invoice',
                'subTitle'          => 'Daftar Invoice',
                'filter'            => false,
                'daftarUser'        => $this->ModelUser->findAll('id_user', 'DESC'),
                'daftarInvoice'     => $this->ModelInvoice->findAll('id_invoice', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        } else {
            if(Request()->filter_by === 'Sales') {
                $daftarInvoice = $this->ModelInvoice->findAllWhere('id_invoice', 'DESC', Request()->id_user, Request()->filter_by);
                $user = $this->ModelUser->findOne('id_user', Request()->id_user);
                $filterValue = $user->fullname . ' | ' .  $user->user_address;
            } else if(Request()->filter_by === 'Tanggal') {
                $daftarInvoice = $this->ModelInvoice->findAllByTanggal('id_invoice', 'DESC', Request()->date_from, Request()->date_to);
                $filterValue = "dari ". Request()->date_from . " sampai " . Request()->date_to;
            }

            $data = [
                'title'             => 'Data Invoice',
                'subTitle'          => 'Daftar Invoice',
                'filter'            => true,
                'filterBy'          => Request()->filter_by,
                'filterValue'       => $filterValue,
                'daftarInvoice'     => $daftarInvoice,
                'daftarUser'        => $this->ModelUser->findAll('id_user', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        }

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
        $user = $this->ModelUser->findOne('user_code', $data[3][2]);
        if($user == null) {
            return back()->with('fail', 'Kode user '.$data[3][2].' tidak ada!'); 
        }
        $dataInvoice = [
            'id_user'   => $user->id_user,
            'date'      => date('Y-m-d', strtotime(str_replace('/', '-', $data[1][2]))),
            'day'       => $data[2][2],
            'user_code_invoice' => $data[3][2]
        ];
        $this->ModelInvoice->create($dataInvoice);

        $lastDataInvoice = $this->ModelInvoice->lastData();

        $data = array_slice($data, 7, null, true);
        foreach ($data as $row) {
            $store = $this->ModelStore->findOne('store_code', $row[1]);
            if($store == null) {
                $this->ModelDetailInvoice->deleteData('id_invoice', $lastDataInvoice->id_invoice);
                $this->ModelInvoice->deleteData('id_invoice', $lastDataInvoice->id_invoice);
                return back()->with('fail', 'Kode store '.$row[1].' tidak ada!');
            }
            $dataDetailInvoice = [
                'id_invoice'        => $lastDataInvoice->id_invoice,
                'id_store'          => $store->id_store,
                'store_code'        => $row[1],
                'store_name'        => $row[2],
                'bill'              => (int) str_replace('.', '', $row[3]),
                'limit'             => (int) str_replace('.', '', $row[4]),
                'group_price'       => $row[5],
                'activation_date'   => date('Y-d-m', strtotime($row[6])),
                'store_status_ar'   => $row[7]
            ];
            $this->ModelDetailInvoice->create($dataDetailInvoice);

            $dataStore = [
                'id_store'          => $store->id_store,
                'store_status_ar'   => $row[7]
            ];
            $this->ModelStore->edit($dataStore);
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

    public function export($id_invoice)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $invoice = $this->ModelInvoice->findOne('id_invoice', $id_invoice);
        $daftarDetailInvoice = $this->ModelDetailInvoice->findAll('id_detail_invoice', 'ASC');
        $user = $this->ModelUser->findOne('user_code', $invoice->user_code_invoice);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A2:B2');
        $sheet->setCellValue('A2', 'TANGGAL CETAK');
        $sheet->setCellValue('C2', date('d/m/Y', strtotime($invoice->date)));
        $sheet->mergeCells('A3:B3');
        $sheet->setCellValue('A3', 'JADWAL');
        $sheet->setCellValue('C3', $invoice->day);
        $sheet->mergeCells('A4:B4');
        $sheet->setCellValue('A4', 'NAMA SALES');
        $sheet->setCellValue('C4', $user ? $user->user_code .' - '. $user->fullname : $invoice->user_code_invoice);

        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'ID');
        $sheet->setCellValue('C6', 'Nama Store');
        $sheet->setCellValue('D6', 'Tagihan');
        $sheet->setCellValue('E6', 'Limit');
        $sheet->setCellValue('F6', 'Harga Grup');
        $sheet->setCellValue('G6', 'Tanggal Aktifasi');
        $sheet->setCellValue('H6', 'ADD');
        $sheet->setCellValue('I6', 'Sisa Saldo');
        $sheet->setCellValue('J6', 'Keterangan');
        $sheet->setCellValue('K6', 'Kunjungan');
        $sheet->setCellValue('L6', 'Absensi');
        $sheet->setCellValue('M6', 'catatan Untuk Sales');

        $row = 7;
        $no = 1;
        foreach ($daftarDetailInvoice as $item) {
            if($item->id_invoice == $invoice->id_invoice) {
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $item->store_code);
                $sheet->setCellValue('C' . $row, $item->store_name);
                $sheet->setCellValue('D' . $row, $item->bill);
                $sheet->setCellValue('E' . $row, $item->limit);
                $sheet->setCellValue('F' . $row, $item->group_price);
                $sheet->setCellValue('G' . $row, date('d/m/Y', strtotime($item->activation_date)));
                $sheet->setCellValue('H' . $row, $item->add);
                $sheet->setCellValue('I' . $row, $item->remaining_balance);
                $sheet->setCellValue('J' . $row, $item->notes);
                $sheet->setCellValue('K' . $row, $item->visit == 1 ? 'Ya' : 'Tidak');
                $sheet->setCellValue('L' . $row, $item->absensi);
                $sheet->setCellValue('M' . $row, $item->notes_for_salesman);
                $row++;
            }
        }

        $headerStyle = [
            'font' => ['bold' => true]
            // 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '90EE90']],
        ];
        $sheet->getStyle('A6:M6')->applyFromArray($headerStyle);

        $fileName = 'invoice-'.date('d-m-Y', strtotime($invoice->date)).'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
