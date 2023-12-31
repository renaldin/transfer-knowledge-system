<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSales;
use App\Models\ModelUser;
use App\Models\ModelSalesDetail;
use App\Models\ModelProduct;

class Sales extends Controller
{

    private $ModelSales, $ModelUser, $ModelSalesDetail, $ModelProduct;

    public function __construct()
    {
        $this->ModelSales = new ModelSales();
        $this->ModelUser = new ModelUser();
        $this->ModelProduct = new ModelProduct();
        $this->ModelSalesDetail = new ModelSalesDetail();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Penjualan',
            'subTitle'          => 'Daftar Penjualan',
            'daftarSales'       => $this->ModelSales->findAll('id_sales', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('selling.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->customer_name) {
            $data = [
                'title'     => 'Penjualan',
                'subTitle'  => 'Tambah Penjualan',
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('selling.form', $data);
        } else {
            Request()->validate([
                'sales_code'        => 'required|unique:sales,sales_code',
                'sales_date'        => 'required',
                'customer_name'     => 'required',
                'customer_address'  => 'required',
                'customer_phone'    => 'required',
                'payment_type'      => 'required',
                'notes'             => 'required'
            ], [
                'sales_code.required'       => 'Kode penjualan harus diisi!',
                'sales_code.unique'         => 'Kode penjualan sudah digunakan!',
                'sales_date.required'       => 'Tanggal penjualan harus diisi!',
                'customer_name.required'    => 'Nama pelanggan harus diisi!',
                'customer_address.required' => 'Alamat pelanggan harus diisi!',
                'customer_phone.required'   => 'Nomor telepon harus diisi!',
                'payment_type.required'     => 'Tipe pembayaran harus diisi!',
                'notes.required'            => 'Catatan harus diisi!'
            ]);

            $data = [
                'sales_code'        => Request()->sales_code,
                'sales_date'        => Request()->sales_date,
                'customer_name'     => Request()->customer_name,
                'customer_address'  => Request()->customer_address,
                'customer_phone'    => Request()->customer_phone,
                'payment_type'      => Request()->payment_type,
                'notes'             => Request()->notes
            ];
            $this->ModelSales->create($data);

            return redirect()->route('daftar-penjualan')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->customer_name) {
            $data = [
                'title'         => 'Penjualan',
                'subTitle'      => 'Edit Penjualan',
                'form'          => 'Edit',
                'detail'        => $this->ModelSales->findOne('id_sales', $id_sales),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('selling.form', $data);
        } else {
            Request()->validate([
                'sales_code'        => 'required',
                'sales_date'        => 'required',
                'customer_name'     => 'required',
                'customer_address'  => 'required',
                'customer_phone'    => 'required',
                'payment_type'      => 'required',
                'notes'             => 'required'
            ], [
                'sales_code.required'       => 'Kode penjualan harus diisi!',
                'sales_date.required'       => 'Tanggal penjualan harus diisi!',
                'customer_name.required'    => 'Nama pelanggan harus diisi!',
                'customer_address.required' => 'Alamat pelanggan harus diisi!',
                'customer_phone.required'   => 'Nomor telepon harus diisi!',
                'payment_type.required'     => 'Tipe pembayaran harus diisi!',
                'notes.required'            => 'Catatan harus diisi!'
            ]);

            $data = [
                'id_sales'          => $id_sales,
                'sales_code'        => Request()->sales_code,
                'sales_date'        => Request()->sales_date,
                'customer_name'     => Request()->customer_name,
                'customer_address'  => Request()->customer_address,
                'customer_phone'    => Request()->customer_phone,
                'payment_type'      => Request()->payment_type,
                'notes'             => Request()->notes
            ];
            
            $this->ModelSales->edit($data);
            return redirect()->route('daftar-penjualan')->with('success', 'Data berhasil diedit!');
        }
    }

    public function pay($id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $sales = $this->ModelSales->findOne('id_sales', $id_sales);

        $data = [
            'id_sales'          => $id_sales,
            'total_pay'         => (int) str_replace('.', '', Request()->total_pay),
            'remaining_amount'  => $sales->total_amount - (int) str_replace('.', '', Request()->total_pay)
        ];
        
        $this->ModelSales->edit($data);
        return back()->with('success', 'Anda berhasil update pembayaran!');
    }

    public function nota($id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $sales = $this->ModelSales->findOne('id_sales', $id_sales);

        $data = [
            'title'     => 'Penjualan',
            'subTitle'  => 'Nota Penjualan',
            'sales'     => $this->ModelSales->findOne('id_sales', $id_sales),
            'salesDetail' => $this->ModelSalesDetail->findAll('id_sales_detail', 'DESC'),
            'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            'detail'    => $sales,
        ];
        return view('selling.nota', $data);
    }

    public function delete($id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $daftarSalesDetail = $this->ModelSalesDetail->findAll('id_sales_detail', 'DESC');
        foreach($daftarSalesDetail as $item) {
            if($item->id_sales == $id_sales) {
                $product = $this->ModelProduct->findOne('id_product', $item->id_product);
                $dataProduct = [
                    'id_product'    => $item->id_product,
                    'last_stock'    => $product->last_stock + $item->quantity_sales
                ];
                $this->ModelProduct->edit($dataProduct);
            }
        }
        
        $this->ModelSales->deleteData('id_sales', $id_sales);
        $this->ModelSalesDetail->deleteData('id_sales', $id_sales);

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
