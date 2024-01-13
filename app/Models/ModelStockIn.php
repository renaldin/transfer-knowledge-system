<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelStockIn extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('stock_in')
            ->join('stock', 'stock.id_stock', '=', 'stock_in.id_stock')
            ->join('user', 'user.id_user', '=', 'stock_in.id_user')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->orderBy($order, $by)
            ->get();
    }

    public function findAllWhere($order, $by, $dateFrom, $dateTo)
    {
        return DB::table('stock_in')
            ->join('stock', 'stock.id_stock', '=', 'stock_in.id_stock')
            ->join('user', 'user.id_user', '=', 'stock_in.id_user')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->whereBetween('stock_in.date_stock_in', [$dateFrom, $dateTo])
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('stock_in')
            ->join('stock', 'stock.id_stock', '=', 'stock_in.id_stock')
            ->join('user', 'user.id_user', '=', 'stock_in.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('stock_in')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('stock_in')->where('id_stock_in', $data['id_stock_in'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('stock_in')->where($where, $value)->delete();
    }
}
