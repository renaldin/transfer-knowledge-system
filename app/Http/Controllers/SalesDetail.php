<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSales;
use App\Models\ModelUser;
use App\Models\ModelSalesDetail;
use App\Models\ModelProduct;

class SalesDetail extends Controller
{

    private $ModelSales, $ModelUser, $ModelSalesDetail, $ModelProduct;

    public function __construct()
    {
        $this->ModelSales = new ModelSales();
        $this->ModelUser = new ModelUser();
        $this->ModelSalesDetail = new ModelSalesDetail();
        $this->ModelProduct = new ModelProduct();
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

        if(!Request()->id_product) {
            $data = [
                'title'     => 'Detail Penjualan',
                'subTitle'  => 'Tambah Detail Penjualan',
                'produk'    => $this->ModelProduct->findAll('id_product', 'DESC'),
                'sales'     => $this->ModelSales->findOne('id_sales', $id_sales),
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Tambah',
            ];
            return view('sellingDetail.form', $data);
        } else {
            Request()->validate([
                'id_product'            => 'required',
                'quantity_sales'        => 'required'
            ], [
                'id_product.required'           => 'Produk harus diisi!',
                'quantity_sales.required'       => 'Kuantitas harus diisi!'
            ]);

            $sales = $this->ModelSales->findOne('id_sales', Request()->id_sales);
            $product = $this->ModelProduct->findOne('id_product', Request()->id_product);

            if ($sales->payment_type === 'Cash') {
                $sellPriceSales = $product->sell_price_cash;
            } else if($sales->payment_type === 'Tempo') {
                $sellPriceSales = $product->sell_price_tempo;
            }

            $data = [
                'id_product'            => $product->id_product,
                'id_sales'              => $sales->id_sales,
                'purchase_price_sales'  => $product->purchase_price,
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

            $dataProduct = [
                'id_product'    => $product->id_product,
                'last_stock'    => $product->last_stock - Request()->quantity_sales
            ];
            $this->ModelProduct->edit($dataProduct);

            return redirect('/detail-penjualan/'.$sales->id_sales)->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function update($id_sales_detail, $id_sales)
    {
        if (!Session()->get('role')) {
            return redirect()->route('login');
        }

        if(!Request()->id_product) {
            $data = [
                'title'     => 'Detail Penjualan',
                'subTitle'  => 'Edit Detail Penjualan',
                'produk'    => $this->ModelProduct->findAll('id_product', 'DESC'),
                'sales'     => $this->ModelSales->findOne('id_sales', $id_sales),
                'detail'    => $this->ModelSalesDetail->findOne('id_sales_detail', $id_sales_detail),
                'user'      => $this->ModelUser->findOne('id_user', Session()->get('id_user')),
                'form'      => 'Edit',
            ];
            return view('sellingDetail.form', $data);
        } else {
            Request()->validate([
                'id_product'            => 'required',
                'quantity_sales'        => 'required'
            ], [
                'id_product.required'           => 'Produk harus diisi!',
                'quantity_sales.required'       => 'Kuantitas harus diisi!'
            ]);
    
            $sales = $this->ModelSales->findOne('id_sales', Request()->id_sales);
            $product = $this->ModelProduct->findOne('id_product', Request()->id_product);
            $salesDetail = $this->ModelSalesDetail->findOne('id_sales_detail', $id_sales_detail);
    
            if ($sales->payment_type === 'Cash') {
                $sellPriceSales = $product->sell_price_cash;
            } else if($sales->payment_type === 'Tempo') {
                $sellPriceSales = $product->sell_price_tempo;
            }

            $totalPrice = Request()->quantity_sales * $sellPriceSales;
    
            $data = [
                'id_sales_detail'       => $salesDetail->id_sales_detail,
                'id_product'            => $product->id_product,
                'id_sales'              => $sales->id_sales,
                'purchase_price_sales'  => $product->purchase_price,
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
    
            $dataProduct = [
                'id_product'    => $product->id_product,
                'last_stock'    => $product->last_stock + $salesDetail->quantity_sales - Request()->quantity_sales
            ];
            $this->ModelProduct->edit($dataProduct);
    
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
        $product = $this->ModelProduct->findOne('id_product', $salesDetail->id_product);

        $dataSales = [
            'id_sales'          => $sales->id_sales,
            'total_qty'         => $sales->total_qty - $salesDetail->quantity_sales,
            'total_amount'      => $sales->total_amount - $salesDetail->total_price,
            'remaining_amount'  => $sales->total_amount - $salesDetail->total_price - $sales->total_pay
        ];
        $this->ModelSales->edit($dataSales);

        $dataProduct = [
            'id_product'    => $product->id_product,
            'last_stock'    => $product->last_stock + $salesDetail->quantity_sales
        ];
        $this->ModelProduct->edit($dataProduct);
        
        $this->ModelSalesDetail->deleteData('id_sales_detail', $id_sales_detail);

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
