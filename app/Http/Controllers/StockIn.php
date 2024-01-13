<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelStock;
use App\Models\ModelUser;
use App\Models\ModelStockIn;

class StockIn extends Controller
{

    private $ModelStock, $ModelUser, $ModelStockIn;

    public function __construct()
    {
        $this->ModelStock = new ModelStock();
        $this->ModelUser = new ModelUser();
        $this->ModelStockIn = new ModelStockIn();
    }

    public function index($id_stock)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Data Produk',
            'subTitle'          => 'Daftar Stok Masuk',
            'stock'             => $this->ModelStock->findOne('id_stock', $id_stock),
            'daftarStockIn'     => $this->ModelStockIn->findAll('id_stock_in', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('stockIn.index', $data);
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
