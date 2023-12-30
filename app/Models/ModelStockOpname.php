<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelStockOpname extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('stock_opname')
            ->join('product', 'product.id_product', '=', 'stock_opname.id_product')
            ->join('user', 'user.id_user', '=', 'stock_opname.id_user')
            ->orderBy($order, $by)
            ->get();
    }

    public function findAllWhere($order, $by, $dateFrom, $dateTo)
    {
        return DB::table('stock_opname')
            ->join('product', 'product.id_product', '=', 'stock_opname.id_product')
            ->join('user', 'user.id_user', '=', 'stock_opname.id_user')
            ->whereBetween('stock_opname.date_opname', [$dateFrom, $dateTo])
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('stock_opname')
            ->join('product', 'product.id_product', '=', 'stock_opname.id_product')
            ->join('user', 'user.id_user', '=', 'stock_opname.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('stock_opname')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('stock_opname')->where('id_stock_opname', $data['id_stock_opname'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('stock_opname')->where($where, $value)->delete();
    }
}
