<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
