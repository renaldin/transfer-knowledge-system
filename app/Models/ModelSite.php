<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelSite extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('site')->orderBy($order, $by)->get();
    }
    
    public function lastData($order, $by)
    {
        return DB::table('site')->orderBy($order, $by)->first();
    }

    public function findOne($where, $value)
    {
        return DB::table('site')->where($where, $value)->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('site')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('site')->where('id_site', $data['id_site'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('site')->where($where, $value)->delete();
    }
}
