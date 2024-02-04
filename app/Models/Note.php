<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    use HasFactory;
    protected $table = 'note';

    public function findAll($order, $by)
    {
        return DB::table('note')->orderBy($order, $by)->get();
    }
}
