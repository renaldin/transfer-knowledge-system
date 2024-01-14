<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelSales extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('sales')
            ->join('site', 'site.id_site', '=', 'sales.id_site')
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('sales')
            ->join('site', 'site.id_site', '=', 'sales.id_site')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('sales')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('sales')->where('id_sales', $data['id_sales'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('sales')->where($where, $value)->delete();
    }
}
