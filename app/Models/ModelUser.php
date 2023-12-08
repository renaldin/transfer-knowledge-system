<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelUser extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('user')->orderBy($order, $by)->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('user')->where($where, $value)->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('user')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('user')->where('id_user', $data['id_user'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('user')->where($where, $value)->delete();
    }
}
