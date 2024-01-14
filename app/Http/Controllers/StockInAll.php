<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelStock;
use App\Models\ModelUser;
use App\Models\ModelSite;
use App\Models\ModelProduct;
use App\Models\ModelStockIn;
use App\Models\ModelSiteDetail;

class StockInAll extends Controller
{

    private $ModelStock, $ModelUser, $ModelStockIn, $ModelSite, $ModelProduct, $ModelSiteDetail;

    public function __construct()
    {
        $this->ModelStock = new ModelStock();
        $this->ModelUser = new ModelUser();
        $this->ModelStockIn = new ModelStockIn();
        $this->ModelSite = new ModelSite();
        $this->ModelProduct = new ModelProduct();
        $this->ModelSiteDetail = new ModelSiteDetail();
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

        if(!Request()->filter_by) {
            $data = [
                'title'             => 'Data Stok Masuk',
                'subTitle'          => 'Data Stok Masuk',
                'filter'            => false,
                'siteUser'          => $siteUser,
                'daftarSite'        => $this->ModelSite->findAll('id_site', 'DESC'),
                'daftarProduk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStock'       => $this->ModelStock->findAll('id_stock', 'DESC'),
                'daftarStockIn'     => $this->ModelStockIn->findAll('id_stock_in', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'daftarStockSite'   => $this->ModelSiteDetail->findAllStockBySite($siteUser),
            ];
        } else {
            if(Request()->filter_by === 'Produk') {
                $daftarStokIn = $this->ModelStockIn->findAllWhere('id_stock_in', 'DESC', Request()->id_product, Request()->filter_by);
                $product = $this->ModelProduct->findOne('id_product', Request()->id_product);
                $filterValue = $product->product_code . ' | ' .  $product->product_name;
            } else if(Request()->filter_by === 'Site') {
                $daftarStokIn = $this->ModelStockIn->findAllWhere('id_stock_in', 'DESC', Request()->id_site, Request()->filter_by);
                $site = $this->ModelSite->findOne('id_site', Request()->id_site);
                $filterValue = $site->site_name . ' | ' .  $site->site_address;
            } else if(Request()->filter_by === 'Tanggal') {
                $daftarStokIn = $this->ModelStockIn->findAllByTanggal('id_stock_in', 'DESC', Request()->date_from, Request()->date_to);
                $filterValue = "dari ". Request()->date_from . " sampai " . Request()->date_to;
            }

            $data = [
                'title'             => 'Data Stok Masuk',
                'subTitle'          => 'Data Stok Masuk',
                'filter'            => true,
                'siteUser'          => $siteUser,
                'filterBy'          => Request()->filter_by,
                'filterValue'       => $filterValue,
                'daftarSite'        => $this->ModelSite->findAll('id_site', 'DESC'),
                'daftarProduk'      => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStock'       => $this->ModelStock->findAll('id_stock', 'DESC'),
                'daftarStockIn'     => $daftarStokIn,
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'daftarStockSite'   => $this->ModelSiteDetail->findAllStockBySite($siteUser),
            ];
        }

        return view('stockInAll.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStock = $this->ModelStock->findOne('id_stock', Request()->id_stock);
        
        $data = [
            'id_stock'          => Request()->id_stock,
            'quantity'          => Request()->quantity,
            'date_stock_in'     => Request()->date_stock_in,
            'desc_stock_in'     => Request()->desc_stock_in,
            'id_user'           => Session()->get('id_user')
        ];
        $this->ModelStockIn->create($data);

        $stock = [
            'id_stock'      => Request()->id_stock,
            'early_stock'   => $detailStock->early_stock + Request()->quantity,
            'last_stock'    => $detailStock->last_stock + Request()->quantity
        ];
        $this->ModelStock->edit($stock);

        return back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update($id_stock_in)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStockIn = $this->ModelStockIn->findOne('id_stock_in', $id_stock_in);
        $detailStock = $this->ModelStock->findOne('id_stock', Request()->id_stock);

        $subtractionStock = [
            'id_stock'      => $detailStock->id_stock,
            'early_stock'   => $detailStock->early_stock - $detailStockIn->quantity,
            'last_stock'    => $detailStock->last_stock - $detailStockIn->quantity
        ];
        $this->ModelStock->edit($subtractionStock);

        $data = [
            'id_stock_in'       => $id_stock_in,
            'id_stock'          => Request()->id_stock,
            'quantity'          => Request()->quantity,
            'date_stock_in'     => Request()->date_stock_in,
            'desc_stock_in'     => Request()->desc_stock_in,
            'id_user'           => Session()->get('id_user'),
        ];
        $this->ModelStockIn->edit($data);

        $detailStockNew = $this->ModelStock->findOne('id_stock', Request()->id_stock);

        $stock = [
            'id_stock'      => Request()->id_stock,
            'early_stock'   => $detailStockNew->early_stock + Request()->quantity,
            'last_stock'    => $detailStockNew->last_stock + Request()->quantity
        ];
        $this->ModelStock->edit($stock);

        return back()->with('success', 'Data berhasil diedit!');
    }

    public function delete($id_stock_in)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $detailStockIn = $this->ModelStockIn->findOne('id_stock_in', $id_stock_in);
        $detailStock = $this->ModelStock->findOne('id_stock', $detailStockIn->id_stock);

        $subtractionStock = [
            'id_stock'      => $detailStock->id_stock,
            'early_stock'   => $detailStock->early_stock - $detailStockIn->quantity,
            'last_stock'    => $detailStock->last_stock - $detailStockIn->quantity
        ];

        $this->ModelStock->edit($subtractionStock);
        $this->ModelStockIn->deleteData('id_stock_in', $id_stock_in);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
