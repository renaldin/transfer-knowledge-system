<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;

class Dashboard extends Controller
{

    private $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        if (!Session()->get('id_user')) {
            return redirect()->route('login');
        }

        $role = Session()->get('role');
        $user = $this->ModelUser->findOne('id_user', Session()->get('id_user'));

        if ($role === 'Administrator') {
            $route = 'admin.dashboard';
            $data = [
                'title'     => null,
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Sales') {
            $route = 'sales.dashboard';
            $data = [
                'title'     => null,
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        } elseif ($role === 'Admin Cabang') {
            $route = 'adminCabang.dashboard';
            $data = [
                'title'     => null,
                'subTitle'  => 'Dashboard',
                'user'      => $user,
            ];
        };

        return view($route, $data);
    }
}
