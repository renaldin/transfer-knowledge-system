<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelInvoice extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('invoice')
            ->join('user', 'user.id_user', '=', 'invoice.id_user')
            ->orderBy($order, $by)->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('invoice')
            ->join('user', 'user.id_user', '=', 'invoice.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('invoice')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('invoice')->where('id_invoice', $data['id_invoice'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('invoice')->where($where, $value)->delete();
    }

    public function lastData() 
    {
        return DB::table('invoice')
            ->join('user', 'user.id_user', '=', 'invoice.id_user')
            ->orderBy('id_invoice', 'DESC')->limit(1)->first();
    }
}
