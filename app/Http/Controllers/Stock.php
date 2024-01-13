<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;
use App\Models\ModelUser;
use App\Models\ModelStock;
use App\Models\ModelSite;
use App\Models\ModelStockOpname;

class Stock extends Controller
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

    public function index($id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Produk',
            'subTitle'          => 'Daftar Stok',
            'produk'            => $this->ModelProduct->findOne('id_product', $id_product),
            'daftarStok'        => $this->ModelStock->findAll('id_stock', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('stock.index', $data);
    }

    public function new($id_product)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->id_site) {
            $data = [
                'title'     => 'Data Stok',
                'subTitle'  => 'Tambah Stok',
                'produk'    => $this->ModelProduct->findOne('id_product', $id_product),
                'daftarSite' => $this->ModelSite->findAll('id_site', 'DESC'),
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('stock.form', $data);
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
                return redirect("/daftar-stok/".$id_product)->with('fail', "Stok dengan produk $detailProduct->product_name dan site $detailSite->site_name tersebut sudah ada!");
            }

            $data = [
                'id_product'        => Request()->id_product,
                'id_site'           => Request()->id_site,
                'purchase_price'    => (int) str_replace('.', '', Request()->purchase_price),
                'sell_price_cash'   => (int) str_replace('.', '', Request()->sell_price_cash),
                'sell_price_tempo'  => (int) str_replace('.', '', Request()->sell_price_tempo)
            ];
            $this->ModelStock->create($data);

            return redirect("/daftar-stok/".$id_product)->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_product, $id_stock)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if (!Request()->id_site) {
            $data = [
                'title'         => 'Data Stok',
                'subTitle'      => 'Edit Stok',
                'form'          => 'Edit',
                'daftarSite'    => $this->ModelSite->findAll('id_site', 'DESC'),
                'produk'        => $this->ModelProduct->findOne('id_product', $id_product),
                'detail'        => $this->ModelStock->findOne('id_stock', $id_stock),
                'user'          => $this->ModelUser->findOne('id_user', Session()->get('id_user'))
            ];
            return view('stock.form', $data);
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

            return redirect("/daftar-stok/".$id_product)->with('success', 'Data berhasil ditambahkan!');
        }
    }

    // public function delete($id_stock, $id_product)
    // {
    //     if (!Session()->get('role')) {
    //         return redirect()->route('login');
    //     }

    //     $detailStock = $this->ModelStock->findOne('id_stock', $id_stock);
    //     $detailProduct = $this->ModelProduct->findOne('id_product', $id_product);

    //     $subtractionStock = [
    //         'id_product'    => $detailProduct->id_product,
    //         'early_stock'   => $detailProduct->early_stock - $detailStock->quantity,
    //         'last_stock'    => $detailProduct->last_stock - $detailStock->quantity
    //     ];
    //     $this->ModelProduct->edit($subtractionStock);
        
    //     $this->ModelStock->deleteData('id_stock', $id_stock);

    //     return back()->with('success', 'Data berhasil dihapus!');
    // }
}
