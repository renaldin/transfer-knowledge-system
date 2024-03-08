<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadreDevelopments extends Model
{
    use HasFactory;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function juniorEmployee()
    {
        return $this->belongsTo(Employees::class, 'junior_employee_id')->with('user');
    }

    public function seniorEmployee()
    {
        return $this->belongsTo(Employees::class, 'senior_employee_id')->with('user');
    }

    public function adminCorporate()
    {
        return $this->belongsTo(Employees::class, 'admin_corporate_id')->with('user');
    }

    public function manager()
    {
        return $this->belongsTo(Employees::class, 'manager_id')->with('user');
    }
}
