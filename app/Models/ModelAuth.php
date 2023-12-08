<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAuth extends Model
{
    use HasFactory;

    public function cekUsernameOrEmail($loginCredential)
    {
        return DB::table('user')
            ->where('username', $loginCredential)
            ->orWhere('email', $loginCredential)
            ->first();
    }
}
