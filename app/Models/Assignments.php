<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function cadreDevelopment() 
    {
        return $this->belongsTo(CadreDevelopments::class, 'cadre_development_id')->with('juniorEmployee', 'seniorEmployee');
    }

    public function manager()
    {
        return $this->belongsTo(Employees::class, 'manager_id')->with('user');
    }
}
