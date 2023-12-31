<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelStock extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('user', 'user.id_user', '=', 'stock.id_user')
            ->orderBy($order, $by)
            ->get();
    }

    public function findAllWhere($order, $by, $dateFrom, $dateTo)
    {
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('user', 'user.id_user', '=', 'stock.id_user')
            ->whereBetween('stock.stock_date', [$dateFrom, $dateTo])
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('user', 'user.id_user', '=', 'stock.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('stock')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('stock')->where('id_stock', $data['id_stock'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('stock')->where($where, $value)->delete();
    }
}
