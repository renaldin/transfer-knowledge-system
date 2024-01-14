<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStockOpname;
use App\Models\ModelStock;
use App\Models\ModelSite;

class StockOpname extends Controller
{

    private $ModelProduct, $ModelUser, $ModelStockOpname, $ModelStock, $ModelSite;

    public function __construct()
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelUser = new ModelUser();
        $this->ModelStockOpname = new ModelStockOpname();
        $this->ModelStock = new ModelStock();
        $this->ModelSite = new ModelSite();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->filter_by) {
            $data = [
                'title'             => 'Data Stok Opname',
                'subTitle'          => 'Data Stok Opname',
                'filter'            => false,
                'daftarSite'        => $this->ModelSite->findAll('id_site', 'DESC'),
                'daftarProduk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStock'       => $this->ModelStock->findAll('id_stock', 'DESC'),
                'daftarStokOpname'  => $this->ModelStockOpname->findAll('id_stock_opname', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        } else {
            if(Request()->filter_by === 'Produk') {
                $daftarStokOpname = $this->ModelStockOpname->findAllWhere('id_stock_opname', 'DESC', Request()->id_product, Request()->filter_by);
                $product = $this->ModelProduct->findOne('id_product', Request()->id_product);
                $filterValue = $product->product_code . ' | ' .  $product->product_name;
            } else if(Request()->filter_by === 'Site') {
                $daftarStokOpname = $this->ModelStockOpname->findAllWhere('id_stock_opname', 'DESC', Request()->id_site, Request()->filter_by);
                $site = $this->ModelSite->findOne('id_site', Request()->id_site);
                $filterValue = $site->site_name . ' | ' .  $site->site_address;
            } else if(Request()->filter_by === 'Tanggal') {
                $daftarStokOpname = $this->ModelStockOpname->findAllByTanggal('id_stock_opname', 'DESC', Request()->date_from, Request()->date_to);
                $filterValue = "dari ". Request()->date_from . " sampai " . Request()->date_to;
            }

            $data = [
                'title'             => 'Data Stok Opname',
                'subTitle'          => 'Data Stok Opname',
                'filter'            => true,
                'filterBy'          => Request()->filter_by,
                'filterValue'       => $filterValue,
                'daftarSite'        => $this->ModelSite->findAll('id_site', 'DESC'),
                'daftarProduk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStock'       => $this->ModelStock->findAll('id_stock', 'DESC'),
                'daftarStokOpname'  => $daftarStokOpname,
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        }

        return view('stockOpname.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStock = $this->ModelStock->findOne('id_stock', Request()->id_stock);
        
        $data = [
            'id_stock'          => Request()->id_stock,
            'quantity_opname'   => Request()->quantity_opname,
            'date_opname'       => Request()->date_opname,
            'desc_opname'       => Request()->desc_opname,
            'id_user'           => Session()->get('id_user')
        ];
        $this->ModelStockOpname->create($data);

        $stock = [
            'id_stock'      => Request()->id_stock,
            'last_stock'    => $detailStock->last_stock + Request()->quantity_opname
        ];
        $this->ModelStock->edit($stock);

        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update($id_stock_opname)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStockOpname = $this->ModelStockOpname->findOne('id_stock_opname', $id_stock_opname);
        $detailStock = $this->ModelStock->findOne('id_stock', Request()->id_stock);

        $subtractionStock = [
            'id_stock'      => $detailStock->id_stock,
            'last_stock'    => $detailStock->last_stock - $detailStockOpname->quantity_opname
        ];
        $this->ModelStock->edit($subtractionStock);

        $data = [
            'id_stock_opname'   => $id_stock_opname,
            'id_stock'          => Request()->id_stock,
            'quantity_opname'   => Request()->quantity_opname,
            'date_opname'       => Request()->date_opname,
            'desc_opname'       => Request()->desc_opname,
            'id_user'           => Session()->get('id_user'),
        ];
        $this->ModelStockOpname->edit($data);

        $detailStockNew = $this->ModelStock->findOne('id_stock', Request()->id_stock);

        $stock = [
            'id_stock'      => Request()->id_stock,
            'last_stock'    => $detailStockNew->last_stock + Request()->quantity_opname
        ];
        $this->ModelStock->edit($stock);

        return back()->with('success', 'Data berhasil diedit!');
    }

    public function delete($id_stock_opname)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStockOpname = $this->ModelStockOpname->findOne('id_stock_opname', $id_stock_opname);
        $detailStock = $this->ModelStock->findOne('id_stock', $detailStockOpname->id_stock);

        $subtractionStock = [
            'id_stock'      => $detailStock->id_stock,
            'last_stock'    => $detailStock->last_stock - $detailStockOpname->quantity_opname
        ];
        $this->ModelStock->edit($subtractionStock);
        
        $this->ModelStockOpname->deleteData('id_stock_opname', $id_stock_opname);

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
