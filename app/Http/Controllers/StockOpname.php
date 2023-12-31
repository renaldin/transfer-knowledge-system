<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStockOpname;

class StockOpname extends Controller
{

    private $ModelProduct, $ModelUser, $ModelStockOpname;

    public function __construct()
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelUser = new ModelUser();
        $this->ModelStockOpname = new ModelStockOpname();
    }

    public function index($id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Stok Opname',
            'subTitle'          => 'Data Stok Opname',
            'produk'            => $this->ModelProduct->findOne('id_product', $id_product),
            'daftarStokOpname'  => $this->ModelStockOpname->findAll('id_stock_opname', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('stockOpname.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'id_product'        => 'required',
            'quantity_opname'   => 'required',
            'date_opname'       => 'required',
            'desc_opname'       => 'required'
        ], [
            'id_product.required'       => 'Produk harus diisi!',
            'quantity_opname.required'  => 'Kuantitas harus diisi!',
            'date_opname.required'      => 'Tanggal harus diisi!',
            'desc_opname.required'      => 'Deskripsi harus diisi!',
        ]);

        $detailProduct = $this->ModelProduct->findOne('id_product', Request()->id_product);
        
        $data = [
            'id_product'        => Request()->id_product,
            'quantity_opname'   => Request()->quantity_opname,
            'date_opname'       => Request()->date_opname,
            'desc_opname'       => Request()->desc_opname,
            'id_user'           => Session()->get('id_user')
        ];
        $this->ModelStockOpname->create($data);

        $product = [
            'id_product'    => Request()->id_product,
            'last_stock'    => $detailProduct->last_stock + Request()->quantity_opname
        ];
        $this->ModelProduct->edit($product);

        return back()->with('success-opname', 'Data berhasil ditambahkan!');
    }

    public function update($id_stock_opname)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'id_product'        => 'required',
            'quantity_opname'   => 'required',
            'date_opname'       => 'required',
            'desc_opname'       => 'required'
        ], [
            'id_product.required'       => 'Produk harus diisi!',
            'quantity_opname.required'  => 'Kuantitas harus diisi!',
            'date_opname.required'      => 'Tanggal harus diisi!',
            'desc_opname.required'      => 'Deskripsi harus diisi!',
        ]);

        $detailStock = $this->ModelStockOpname->findOne('id_stock_opname', $id_stock_opname);
        $detailProduct = $this->ModelProduct->findOne('id_product', Request()->id_product);

        $subtractionStock = [
            'id_product'    => $detailProduct->id_product,
            'last_stock'    => $detailProduct->last_stock - $detailStock->quantity_opname
        ];
        $this->ModelProduct->edit($subtractionStock);

        $data = [
            'id_stock_opname'   => $id_stock_opname,
            'id_product'        => Request()->id_product,
            'quantity_opname'   => Request()->quantity_opname,
            'date_opname'       => Request()->date_opname,
            'desc_opname'       => Request()->desc_opname,
            'id_user'           => Session()->get('id_user'),
        ];
        $this->ModelStockOpname->edit($data);

        $detailProductNew = $this->ModelProduct->findOne('id_product', Request()->id_product);

        $product = [
            'id_product'    => Request()->id_product,
            'last_stock'    => $detailProductNew->last_stock + Request()->quantity_opname
        ];
        $this->ModelProduct->edit($product);

        return back()->with('success-opname', 'Data berhasil diedit!');
    }

    public function delete($id_stock_opname, $id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStock = $this->ModelStockOpname->findOne('id_stock_opname', $id_stock_opname);
        $detailProduct = $this->ModelProduct->findOne('id_product', $id_product);

        $subtractionStock = [
            'id_product'    => $detailProduct->id_product,
            'last_stock'    => $detailProduct->last_stock - $detailStock->quantity_opname
        ];
        $this->ModelProduct->edit($subtractionStock);
        
        $this->ModelStockOpname->deleteData('id_stock_opname', $id_stock_opname);

        return back()->with('success-opname', 'Data berhasil dihapus!');
    }
}
