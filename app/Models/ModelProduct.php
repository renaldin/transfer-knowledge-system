<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelProduct extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('product')->orderBy($order, $by)->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('product')->where($where, $value)->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('product')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('product')->where('id_product', $data['id_product'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('product')->where($where, $value)->delete();
    }
}
