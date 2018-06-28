<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function index()
    {
        return $this->delegate();
    }

    public function delegate()
    {
        if (Auth::check()) {
//            $user = User::where('email', Auth::user()->email)->with('role')->first();
            $user = Auth::user()->load('role');

            switch ($user->role->name) {
                case 'Administrador':
                    return $this->renderAdminDashboard();
                case 'Cajero':
                    return $this->renderCajeroDashboard();
                case 'Cliente':
                    return $this->renderClienteDashboard();
                default:
                    return 'Error Grave de Autentificación, contácte con un administador';
            }
        }

        return redirect('/');
    }

    private function renderAdminDashboard()
    {
        return view('dashboard.admin');

    }    

    private function renderCajeroDashboard()
    {
        return view('dashboard.cajero');
    }

    private function renderClienteDashboard()
    {
        return view('dashboard.cliente');
    }

}
