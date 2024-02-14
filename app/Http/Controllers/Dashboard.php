<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Users;

class Dashboard extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        if (!Session()->get('id')) {
            return redirect()->route('login');
        }

        $role = Session()->get('role');
        $user = Users::find(Session()->get('id'));
       
        if ($role === 'HRD') {
            $route = 'dashboard.dashboardHrd';
            $data = [
                'title'     => 'Dashboard',
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Manager') {
            $route = 'dashboard.dashboardManager';
            $data = [
                'title'     => 'Dashboard',
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Pelamar') {
            $route = 'dashboard.dashboardPelamar';
            $data = [
                'title'     => null,
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        };

        return view($route, $data);
    }
}
