<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    private function viewWithUser(string $view, array $data = [])
    {
        return view($view, array_merge(['user' => Auth::user()], $data));
    }

    public function dashboard()
    {
        return $this->viewWithUser('petugas.dashboard');
    }
}
