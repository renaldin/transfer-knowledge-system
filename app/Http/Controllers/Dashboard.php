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
       
        if ($role === 'Admin IT') {
            $route = 'dashboard.dashboardAdminIt';
            $data = [
                'title'     => 'Dashboard',
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Admin Corporate') {
            $route = 'dashboard.dashboardAdminCorporate';
            $data = [
                'title'     => 'Dashboard',
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Karyawan Senior') {
            $route = 'dashboard.dashboardKaryawanSenior';
            $data = [
                'title'     => 'Dashboard',
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Karyawan Junior') {
            $route = 'dashboard.dashboardKaryawanJunior';
            $data = [
                'title'     => 'Dashboard',
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Manager') {
            $route = 'dashboard.dashboardManager';
            $data = [
                'title'     => null,
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        };

        return view($route, $data);
    }
}
