<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelSiteDetail extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('site_detail')
            ->join('user', 'user.id_user', '=', 'site_detail.id_user')
            ->join('site', 'site.id_site', '=', 'site_detail.id_site')
            ->orderBy($order, $by)->get();
    }

    public function findAllUser($order, $by)
    {
        return DB::table('site_detail')
            ->join('user', 'user.id_user', '=', 'site_detail.id_user')
            ->join('site', 'site.id_site', '=', 'site_detail.id_site')
            ->select('site_detail.id_user', 'site_detail.id_site', 'fullname', 'user_address', 'role', 'photo')
            ->groupBy('site_detail.id_user', 'site_detail.id_site', 'fullname', 'user_address', 'role', 'photo')
            ->orderBy($order, $by)->get();
    }

    public function siteUser($id_user)
    {
        return DB::table('site_detail')
            ->join('user', 'user.id_user', '=', 'site_detail.id_user')
            ->join('site', 'site.id_site', '=', 'site_detail.id_site')
            ->where('site_detail.id_user', $id_user)->get();
    }

    public function dataUser($id_site)
    {
        return DB::table('site_detail')
            ->join('user', 'user.id_user', '=', 'site_detail.id_user')
            ->join('site', 'site.id_site', '=', 'site_detail.id_site')
            ->whereIn('site_detail.id_site', $id_site)
            ->select('site_detail.id_user', 'fullname', 'user_address')
            ->groupBy('site_detail.id_user', 'fullname', 'user_address')
            ->get();
    }

    public function findAllStockBySite($id_site)
    {
        return DB::table('stock')
            ->join('product', 'product.id_product', '=', 'stock.id_product')
            ->join('site', 'site.id_site', '=', 'stock.id_site')
            ->whereIn('stock.id_site', $id_site)
            ->orderBy('id_stock', 'DESC')
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('site_detail')
            ->join('user', 'user.id_user', '=', 'site_detail.id_user')
            ->join('site', 'site.id_site', '=', 'site_detail.id_site')
            ->where($where, $value)
            ->first();
    }

    public function check($id_site, $id_user)
    {
        return DB::table('site_detail')
            ->join('user', 'user.id_user', '=', 'site_detail.id_user')
            ->join('site', 'site.id_site', '=', 'site_detail.id_site')
            ->where('site_detail.id_user', $id_user)
            ->where('site_detail.id_site', $id_site)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('site_detail')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('site_detail')->where('id_site_detail', $data['id_site_detail'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('site_detail')->where($where, $value)->delete();
    }

    public function deleteDataUser($id_user, $id_site)
    {
        DB::table('site_detail')->where('id_user', $id_user)->where('id_site', $id_site)->delete();
    }
}
