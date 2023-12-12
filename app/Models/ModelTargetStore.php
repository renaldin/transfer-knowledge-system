<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelTargetStore extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('target_store')
            ->join('site', 'site.id_site', '=', 'target_store.id_site')
            ->join('user', 'user.id_user', '=', 'target_store.id_user')
            ->orderBy($order, $by)->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('target_store')
            ->join('site', 'site.id_site', '=', 'target_store.id_site')
            ->join('user', 'user.id_user', '=', 'target_store.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('target_store')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('target_store')->where('id_target_store', $data['id_target_store'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('target_store')->where($where, $value)->delete();
    }
}
