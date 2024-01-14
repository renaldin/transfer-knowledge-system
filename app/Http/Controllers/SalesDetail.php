<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSales;
use App\Models\ModelUser;
use App\Models\ModelSalesDetail;
use App\Models\ModelStock;

class SalesDetail extends Controller
{

    private $ModelSales, $ModelUser, $ModelSalesDetail, $ModelStock;

    public function __construct()
    {
        $this->ModelSales = new ModelSales();
        $this->ModelUser = new ModelUser();
        $this->ModelSalesDetail = new ModelSalesDetail();
        $this->ModelStock = new ModelStock();
    }

    public function index($id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Detail Penjualan',
            'subTitle'          => 'Daftar Detail Penjualan',
            'sales'             => $this->ModelSales->findOne('id_sales', $id_sales),
            'daftarSalesDetail' => $this->ModelSalesDetail->findAll('id_sales_detail', 'DESC'),
            'user'              => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
        ];

        return view('sellingDetail.index', $data);
    }

    public function new($id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->id_stock) {
            $data = [
                'title'     => 'Detail Penjualan',
                'subTitle'  => 'Tambah Detail Penjualan',
                'stock'    => $this->ModelStock->findAll('id_stock', 'DESC'),
                'sales'     => $this->ModelSales->findOne('id_sales', $id_sales),
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('sellingDetail.form', $data);
        } else {
            Request()->validate([
                'id_stock'            => 'required',
                'quantity_sales'        => 'required'
            ], [
                'id_stock.required'           => 'Stok harus diisi!',
                'quantity_sales.required'       => 'Kuantitas harus diisi!'
            ]);

            $sales = $this->ModelSales->findOne('id_sales', Request()->id_sales);
            $stock = $this->ModelStock->findOne('id_stock', Request()->id_stock);

            if($stock->last_stock < Request()->quantity_sales) {
                return redirect('/tambah-detail-penjualan/'.$sales->id_sales)->with('fail', 'Stok yang diinput melebihi stok yang ada!');
            }

            if ($sales->payment_type === 'Cash') {
                $sellPriceSales = $stock->sell_price_cash;
            } else if($sales->payment_type === 'Tempo') {
                $sellPriceSales = $stock->sell_price_tempo;
            }

            $data = [
                'id_stock'              => $stock->id_stock,
                'id_sales'              => $sales->id_sales,
                'purchase_price_sales'  => $stock->purchase_price,
                'sell_price_sales'      => $sellPriceSales,
                'quantity_sales'        => Request()->quantity_sales,
                'total_price'           => Request()->quantity_sales * $sellPriceSales
            ];
            $this->ModelSalesDetail->create($data);

            $dataSales = [
                'id_sales'          => $sales->id_sales,
                'total_qty'         => $sales->total_qty + Request()->quantity_sales,
                'total_amount'      => $sales->total_amount + (Request()->quantity_sales * $sellPriceSales),
                'remaining_amount'  => ($sales->total_amount + (Request()->quantity_sales * $sellPriceSales)) - $sales->total_pay
            ];
            // dd($dataSales);
            $this->ModelSales->edit($dataSales);

            $dataStock = [
                'id_stock'      => $stock->id_stock,
                'last_stock'    => $stock->last_stock - Request()->quantity_sales
            ];
            $this->ModelStock->edit($dataStock);

            return redirect('/detail-penjualan/'.$sales->id_sales)->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_sales_detail, $id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->id_stock) {
            $data = [
                'title'     => 'Detail Penjualan',
                'subTitle'  => 'Edit Detail Penjualan',
                'stock'     => $this->ModelStock->findAll('id_stock', 'DESC'),
                'sales'     => $this->ModelSales->findOne('id_sales', $id_sales),
                'detail'    => $this->ModelSalesDetail->findOne('id_sales_detail', $id_sales_detail),
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Edit',
            ];
            return view('sellingDetail.form', $data);
        } else {
            Request()->validate([
                'quantity_sales'        => 'required'
            ], [
                'quantity_sales.required'       => 'Kuantitas harus diisi!'
            ]);
    
            $sales = $this->ModelSales->findOne('id_sales', Request()->id_sales);
            $stock = $this->ModelStock->findOne('id_stock', Request()->id_stock);
            $salesDetail = $this->ModelSalesDetail->findOne('id_sales_detail', $id_sales_detail);

            if($stock->last_stock + $salesDetail->quantity_sales < Request()->quantity_sales) {
                return redirect('/edit-detail-penjualan/'.$salesDetail->id_sales_detail.'/'.$sales->id_sales)->with('fail', 'Stok yang diinput melebihi stok yang ada!');
            }
    
            if ($sales->payment_type === 'Cash') {
                $sellPriceSales = $stock->sell_price_cash;
            } else if($sales->payment_type === 'Tempo') {
                $sellPriceSales = $stock->sell_price_tempo;
            }

            $totalPrice = Request()->quantity_sales * $sellPriceSales;
    
            $data = [
                'id_sales_detail'       => $salesDetail->id_sales_detail,
                'id_stock'              => $stock->id_stock,
                'id_sales'              => $sales->id_sales,
                'purchase_price_sales'  => $stock->purchase_price,
                'sell_price_sales'      => $sellPriceSales,
                'quantity_sales'        => Request()->quantity_sales,
                'total_price'           => $totalPrice
            ];
            $this->ModelSalesDetail->edit($data);

            $kurangiTotalAmount = $sales->total_amount - $salesDetail->total_price;
    
            $dataSales = [
                'id_sales'          => $sales->id_sales,
                'total_qty'         => $sales->total_qty - $salesDetail->quantity_sales + Request()->quantity_sales,
                'total_amount'      => $kurangiTotalAmount + $totalPrice,
                'remaining_amount'  => $kurangiTotalAmount + $totalPrice - $sales->total_pay
            ];
            // dd($dataSales);
            $this->ModelSales->edit($dataSales);
    
            $dataStock = [
                'id_stock'      => $stock->id_stock,
                'last_stock'    => $stock->last_stock + $salesDetail->quantity_sales - Request()->quantity_sales
            ];
            $this->ModelStock->edit($dataStock);
    
            return redirect('/detail-penjualan/'.$sales->id_sales)->with('success', 'Data berhasil diedit!');
        }
    }

    public function delete($id_sales_detail, $id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        $sales = $this->ModelSales->findOne('id_sales', $id_sales);
        $salesDetail = $this->ModelSalesDetail->findOne('id_sales_detail', $id_sales_detail);
        $stock = $this->ModelStock->findOne('id_stock', $salesDetail->id_stock);

        $dataSales = [
            'id_sales'          => $sales->id_sales,
            'total_qty'         => $sales->total_qty - $salesDetail->quantity_sales,
            'total_amount'      => $sales->total_amount - $salesDetail->total_price,
            'remaining_amount'  => $sales->total_amount - $salesDetail->total_price - $sales->total_pay
        ];
        $this->ModelSales->edit($dataSales);

        $dataStock = [
            'id_stock'    => $stock->id_stock,
            'last_stock'    => $stock->last_stock + $salesDetail->quantity_sales
        ];
        $this->ModelStock->edit($dataStock);
        
        $this->ModelSalesDetail->deleteData('id_sales_detail', $id_sales_detail);

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
