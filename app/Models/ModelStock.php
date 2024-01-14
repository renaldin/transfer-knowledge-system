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
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->orderBy($order, $by)
            ->get();
    }

    public function findAllWhere($order, $by, $filter, $filterBy)
    {
        if($filterBy === 'Produk') {
            $where = 'stock.id_product';
        } else if($filterBy === 'Site') {
            $where = 'stock.id_site';
        }
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->where($where, $filter)
            ->orderBy($order, $by)
            ->get();
    }

    public function findAllByTanggal($order, $by, $dateFrom, $dateTo)
    {
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->whereBetween('stock.created_at', [$dateFrom, $dateTo])
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->where($where, $value)
            ->first();
    }

    public function check($id_product, $id_site)
    {
        return DB::table('stock')
            ->where('id_product', $id_product)
            ->where('id_site', $id_site)
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
