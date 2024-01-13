<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelSalesDetail extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('sales_detail')
            ->join('sales', 'sales.id_sales', '=', 'sales_detail.id_sales')
            ->join('stock', 'stock.id_stock', '=', 'sales_detail.id_stock')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('sales_detail')
            ->join('sales', 'sales.id_sales', '=', 'sales_detail.id_sales')
            ->join('stock', 'stock.id_stock', '=', 'sales_detail.id_stock')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('sales_detail')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('sales_detail')->where('id_sales_detail', $data['id_sales_detail'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('sales_detail')->where($where, $value)->delete();
    }
}
