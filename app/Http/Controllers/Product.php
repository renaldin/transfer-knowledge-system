<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStock;
use App\Models\ModelStockOpname;

class Product extends Controller
{

    private $ModelProduct, $ModelUser, $ModelStock, $ModelStockOpname;

    public function __construct()
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelUser = new ModelUser();
        $this->ModelStock = new ModelStock();
        $this->ModelStockOpname = new ModelStockOpname();
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
                'product_desc'      => 'required'
            ], [
                'product_code.required'     => 'Kode produk harus diisi!',
                'product_name.required'     => 'Nama produk harus diisi!',
                'product_desc.required'     => 'Deskripsi harus diisi!'
            ]);

            $data = [
                'product_code'      => Request()->product_code,
                'product_name'      => Request()->product_name,
                'product_desc'      => Request()->product_desc
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
                'product_desc'      => 'required'
            ], [
                'product_code.required'     => 'Kode produk harus diisi!',
                'product_name.required'     => 'Nama produk harus diisi!',
                'product_desc.required'     => 'Deskripsi harus diisi!'
            ]);

            $data = [
                'id_product'        => $id_product,
                'product_code'      => Request()->product_code,
                'product_name'      => Request()->product_name,
                'product_desc'      => Request()->product_desc
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
        
        $stock = $this->ModelStock->findAll('id_stock', 'DESC');
        $stockCondition = '';
        foreach($stock as $item) {
            if($item->id_product == $id_product) {
                if($item->last_stock > 0) {
                    $stockCondition = 'Masih Ada';
                }
            }
        }
        
        if($stockCondition === 'Masih Ada') {
            return back()->with('fail', 'Tidak bisa dihapus! Stok pada produk ini masih ada!');
        }

        $this->ModelProduct->deleteData('id_product', $id_product);
        $this->ModelStock->deleteData('id_product', $id_product);

        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function stok()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->date_from) {
            $data = [
                'title'             => 'Data Produk',
                'subTitle'          => 'Daftar Stok',
                'produk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStok'        => $this->ModelStock->findAll('id_stock', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        } else {
            $data = [
                'title'             => 'Data Produk',
                'subTitle'          => 'Daftar Stok',
                'produk'            => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStok'        => $this->ModelStock->findAllWhere('id_stock', 'DESC', Request()->date_from, Request()->date_to),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        }

        return view('product.stock', $data);
    }

    public function stokOpname()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->date_from) {
            $data = [
                'title'             => 'Data Produk',
                'subTitle'          => 'Daftar Stok Opname',
                'produk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStokOpname'  => $this->ModelStockOpname->findAll('id_stock_opname', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        } else {
            $data = [
                'title'             => 'Data Produk',
                'subTitle'          => 'Daftar Stok Opname',
                'produk'            => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStokOpname'  => $this->ModelStockOpname->findAllWhere('id_stock_opname', 'DESC', Request()->date_from, Request()->date_to),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        }

        return view('product.stockOpname', $data);
    }
}
