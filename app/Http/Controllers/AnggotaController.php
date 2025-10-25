<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    private function viewWithUser(string $view, array $data = [])
    {
        return view($view, array_merge(['user' => Auth::user()], $data));
    }

    public function dashboard()
    {
        return $this->viewWithUser('anggota.dashboard');
    }
}
