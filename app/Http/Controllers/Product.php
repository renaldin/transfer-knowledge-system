<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStock;

class Product extends Controller
{

    private $ModelProduct, $ModelUser, $ModelStock;

    public function __construct()
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelUser = new ModelUser();
        $this->ModelStock = new ModelStock();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Produk',
            'subTitle'          => 'Daftar Produk',
            'daftarProduk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('product.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->product_name) {
            $data = [
                'title'     => 'Data Product',
                'subTitle'  => 'Tambah Product',
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('product.form', $data);
        } else {
            Request()->validate([
                'product_code'      => 'required',
                'product_name'      => 'required',
                'product_desc'      => 'required',
                'purchase_price'    => 'required',
                'sell_price_cash'   => 'required',
                'sell_price_tempo'  => 'required'
            ], [
                'product_code.required'     => 'Kode produk harus diisi!',
                'product_name.required'     => 'Nama produk harus diisi!',
                'product_desc.required'     => 'Deskripsi harus diisi!',
                'purchase_price.required'   => 'Harga pembelian harus diisi!',
                'sell_price_cash.required'  => 'Harga jual cash harus diisi!',
                'sell_price_tempo.required' => 'Harga jual tempo harus diisi!'
            ]);

            $data = [
                'product_code'      => Request()->product_code,
                'product_name'      => Request()->product_name,
                'product_desc'      => Request()->product_desc,
                'purchase_price'    => (int) str_replace('.', '', Request()->purchase_price),
                'sell_price_cash'   => (int) str_replace('.', '', Request()->sell_price_cash),
                'sell_price_tempo'  => (int) str_replace('.', '', Request()->sell_price_tempo)
            ];
            $this->ModelProduct->create($data);

            return redirect()->route('daftar-produk')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->product_name) {
            $data = [
                'title'         => 'Data Produk',
                'subTitle'      => 'Edit Produk',
                'form'          => 'Edit',
                'detail'        => $this->ModelProduct->findOne('id_product', $id_product),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('product.form', $data);
        } else {
            Request()->validate([
                'product_code'      => 'required',
                'product_name'      => 'required',
                'product_desc'      => 'required',
                'purchase_price'    => 'required',
                'sell_price_cash'   => 'required',
                'sell_price_tempo'  => 'required'
            ], [
                'product_code.required'     => 'Kode produk harus diisi!',
                'product_name.required'     => 'Nama produk harus diisi!',
                'product_desc.required'     => 'Deskripsi harus diisi!',
                'purchase_price.required'   => 'Harga pembelian harus diisi!',
                'sell_price_cash.required'  => 'Harga jual cash harus diisi!',
                'sell_price_tempo.required' => 'Harga jual tempo harus diisi!'
            ]);

            $data = [
                'id_product'        => $id_product,
                'product_code'      => Request()->product_code,
                'product_name'      => Request()->product_name,
                'product_desc'      => Request()->product_desc,
                'purchase_price'    => (int) str_replace('.', '', Request()->purchase_price),
                'sell_price_cash'   => (int) str_replace('.', '', Request()->sell_price_cash),
                'sell_price_tempo'  => (int) str_replace('.', '', Request()->sell_price_tempo)
            ];
            
            $this->ModelProduct->edit($data);
            return redirect()->route('daftar-produk')->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }
        
        $this->ModelProduct->deleteData('id_product', $id_product);
        $this->ModelStock->deleteData('id_product', $id_product);

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
