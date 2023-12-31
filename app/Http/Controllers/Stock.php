<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStock;
use App\Models\ModelStockOpname;

class Stock extends Controller
{

    private $ModelProduct, $ModelUser, $ModelStock, $ModelStockOpname;

    public function __construct()
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelUser = new ModelUser();
        $this->ModelStock = new ModelStock();
        $this->ModelStockOpname = new ModelStockOpname();
    }

    public function index($id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Stok',
            'subTitle'          => 'Data Stok',
            'produk'            => $this->ModelProduct->findOne('id_product', $id_product),
            'daftarStok'        => $this->ModelStock->findAll('id_stock', 'DESC'),
            'daftarStokOpname'  => $this->ModelStockOpname->findAll('id_stock_opname', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('stock.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'id_product'    => 'required',
            'quantity'      => 'required',
            'stock_date'    => 'required',
            'description'   => 'required'
        ], [
            'id_product.required'   => 'Produk harus diisi!',
            'quantity.required'     => 'Kuantitas harus diisi!',
            'stock_date.required'   => 'Tanggal harus diisi!',
            'description.required'  => 'Deskripsi harus diisi!',
        ]);

        $detailProduct = $this->ModelProduct->findOne('id_product', Request()->id_product);

        $data = [
            'id_product'    => Request()->id_product,
            'quantity'      => Request()->quantity,
            'stock_date'    => Request()->stock_date,
            'description'   => Request()->description,
            'id_user'       => Session()->get('id_user')
        ];
        $this->ModelStock->create($data);

        $product = [
            'id_product'    => Request()->id_product,
            'early_stock'   => $detailProduct->early_stock + Request()->quantity,
            'last_stock'    => $detailProduct->last_stock + Request()->quantity
        ];
        $this->ModelProduct->edit($product);

        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update($id_stock)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'id_product'    => 'required',
            'quantity'      => 'required',
            'stock_date'    => 'required',
            'description'   => 'required'
        ], [
            'id_product.required'   => 'Produk harus diisi!',
            'quantity.required'     => 'Kuantitas harus diisi!',
            'stock_date.required'   => 'Tanggal harus diisi!',
            'description.required'  => 'Deskripsi harus diisi!',
        ]);

        $detailStock = $this->ModelStock->findOne('id_stock', $id_stock);
        $detailProduct = $this->ModelProduct->findOne('id_product', Request()->id_product);

        $subtractionStock = [
            'id_product'    => $detailProduct->id_product,
            'early_stock'   => $detailProduct->early_stock - $detailStock->quantity,
            'last_stock'    => $detailProduct->last_stock - $detailStock->quantity
        ];
        $this->ModelProduct->edit($subtractionStock);

        $data = [
            'id_stock'      => $id_stock,
            'id_product'    => Request()->id_product,
            'quantity'      => Request()->quantity,
            'stock_date'    => Request()->stock_date,
            'description'   => Request()->description,
            'id_user'       => Session()->get('id_user'),
        ];
        $this->ModelStock->edit($data);

        $detailProductNew = $this->ModelProduct->findOne('id_product', Request()->id_product);

        $product = [
            'id_product'    => Request()->id_product,
            'early_stock'   => $detailProductNew->early_stock + Request()->quantity,
            'last_stock'    => $detailProductNew->last_stock + Request()->quantity
        ];
        $this->ModelProduct->edit($product);

        return back()->with('success', 'Data berhasil diedit!');
    }

    public function delete($id_stock, $id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStock = $this->ModelStock->findOne('id_stock', $id_stock);
        $detailProduct = $this->ModelProduct->findOne('id_product', $id_product);

        $subtractionStock = [
            'id_product'    => $detailProduct->id_product,
            'early_stock'   => $detailProduct->early_stock - $detailStock->quantity,
            'last_stock'    => $detailProduct->last_stock - $detailStock->quantity
        ];
        $this->ModelProduct->edit($subtractionStock);
        
        $this->ModelStock->deleteData('id_stock', $id_stock);

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
