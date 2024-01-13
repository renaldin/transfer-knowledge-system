<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStock;
use App\Models\ModelSite;
use App\Models\ModelStockOpname;

class StockAll extends Controller
{

    private $ModelProduct, $ModelUser, $ModelStock, $ModelStockOpname, $ModelSite;

    public function __construct()
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelUser = new ModelUser();
        $this->ModelStock = new ModelStock();
        $this->ModelStockOpname = new ModelStockOpname();
        $this->ModelSite = new ModelSite();
    }

    public function index()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->date_from) {
            $data = [
                'title'             => 'Data Stok',
                'subTitle'          => 'Data Stok',
                'produk'            => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStok'        => $this->ModelStock->findAll('id_stock', 'DESC'),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        } else {
            $data = [
                'title'             => 'Data Stok',
                'subTitle'          => 'Data Stok',
                'produk'            => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarStok'        => $this->ModelStock->findAllWhere('id_stock', 'DESC', Request()->date_from, Request()->date_to),
                'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
            ];
        }

        return view('stockAll.index', $data);
    }

    public function new()
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->id_site) {
            $data = [
                'title'     => 'Data Stok',
                'subTitle'  => 'Tambah Data Stok',
                'daftarProduk'    => $this->ModelProduct->findAll('id_product', 'DESC'),
                'daftarSite' => $this->ModelSite->findAll('id_site', 'DESC'),
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('stockAll.form', $data);
        } else {
            Request()->validate([
                'purchase_price'        => 'required',
                'sell_price_cash'       => 'required',
                'sell_price_tempo'      => 'required'
            ], [
                'purchase_price.required'       => 'Harga beli harus diisi!',
                'sell_price_cash.required'      => 'Harga jual cash harus diisi!',
                'sell_price_tempo.required'     => 'Harga jual tempo harus diisi!'
            ]);

            $check = $this->ModelStock->check(Request()->id_product, Request()->id_site);
            $detailProduct = $this->ModelProduct->findOne('id_product', Request()->id_product);
            $detailSite = $this->ModelSite->findOne('id_site', Request()->id_site);
            if ($check) {
                return redirect()->route('data-stok')->with('fail', "Stok dengan produk $detailProduct->product_name dan site $detailSite->site_name tersebut sudah ada!");
            }

            $data = [
                'id_product'        => Request()->id_product,
                'id_site'           => Request()->id_site,
                'purchase_price'    => (int) str_replace('.', '', Request()->purchase_price),
                'sell_price_cash'   => (int) str_replace('.', '', Request()->sell_price_cash),
                'sell_price_tempo'  => (int) str_replace('.', '', Request()->sell_price_tempo)
            ];
            $this->ModelStock->create($data);

            return redirect()->route('data-stok')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_stock)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if (!Request()->id_site) {
            $data = [
                'title'         => 'Data Stok',
                'subTitle'      => 'Edit Data Stok',
                'form'          => 'Edit',
                'daftarSite'    => $this->ModelSite->findAll('id_site', 'DESC'),
                'daftarProduk'        => $this->ModelProduct->findAll('id_product', 'DESC'),
                'detail'        => $this->ModelStock->findOne('id_stock', $id_stock),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('stockAll.form', $data);
        } else {
            Request()->validate([
                'purchase_price'        => 'required',
                'sell_price_cash'       => 'required',
                'sell_price_tempo'      => 'required'
            ], [
                'purchase_price.required'       => 'Harga beli harus diisi!',
                'sell_price_cash.required'      => 'Harga jual cash harus diisi!',
                'sell_price_tempo.required'     => 'Harga jual tempo harus diisi!'
            ]);

            
            $data = [
                'id_stock'          => $id_stock,
                'purchase_price'    => (int) str_replace('.', '', Request()->purchase_price),
                'sell_price_cash'   => (int) str_replace('.', '', Request()->sell_price_cash),
                'sell_price_tempo'  => (int) str_replace('.', '', Request()->sell_price_tempo)
            ];
            $this->ModelStock->edit($data);

            return redirect()->route('data-stok')->with('success', 'Data berhasil ditambahkan!');
        }
    }
}
