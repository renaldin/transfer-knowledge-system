<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelDetailInvoice extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;

    public function findAll($order, $by)
    {
        return DB::table('detail_invoice')
            ->join('invoice', 'invoice.id_invoice', '=', 'detail_invoice.id_invoice')
            ->orderBy($order, $by)->get();
    }

    public function findOne($where, $value)
    {
        return DB::table('detail_invoice')
            ->join('invoice', 'invoice.id_invoice', '=', 'detail_invoice.id_invoice')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table('detail_invoice')->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table('detail_invoice')->where('id_detail_invoice', $data['id_detail_invoice'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table('detail_invoice')->where($where, $value)->delete();
    }

    public function lastData() 
    {
        return DB::table('detail_invoice')
            ->join('invoice', 'invoice.id_invoice', '=', 'detail_invoice.id_invoice')
            ->orderBy('id_detail_invoice', 'DESC')->limit(1)->first();
    }
}
