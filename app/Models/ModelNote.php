<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelNote extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\Concerns\HasTimestamps;
    protected $table = 'note';

    public function findAll($order, $by)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'note.id_user')
            ->orderBy($order, $by)
            ->get();
    }

    public function findAllWhere($order, $by, $field, $value)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'note.id_user')
            ->where($field, $value)
            ->orderBy($order, $by)
            ->get();
    }

    public function findOne($where, $value)
    {
        return DB::table($this->table)
            ->join('user', 'user.id_user', '=', 'note.id_user')
            ->where($where, $value)
            ->first();
    }

    public function create($data)
    {
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        DB::table($this->table)->insert($data);
    }

    public function edit($data)
    {
        $data['updated_at'] = Carbon::now();
        
        DB::table($this->table)->where('id_user', $data['id_user'])->update($data);
    }

    public function deleteData($where, $value)
    {
        DB::table($this->table)->where($where, $value)->delete();
    }
}
