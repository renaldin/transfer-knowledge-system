<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelStore extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('store')
            ->join('site', 'site.id_site', '=', 'store.id_site')
            ->join('user', 'user.id_user', '=', 'store.id_user')
            ->orderBy($order, $by)->get();
    }

    public function findAllWhere($order, $by, $filter, $filterBy)
    {
        if($filterBy === 'Sales') {
            $where = 'store.id_user';
        } else if($filterBy === 'Site') {
            $where = 'store.id_site';
        }
        return DB::table('store')
            ->join('site', 'site.id_site', '=', 'store.id_site')
            ->join('user', 'user.id_user', '=', 'store.id_user')
            ->where($where, $filter)
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('store')
            ->join('site', 'site.id_site', '=', 'store.id_site')
            ->join('user', 'user.id_user', '=', 'store.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('store')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('store')->where('id_store', $data['id_store'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('store')->where($where, $value)->delete();
    }
}
