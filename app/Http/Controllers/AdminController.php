<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Filme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }

        $totalEstudios = Estudio::count();
        $totalFilmes = Filme::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalEstudios', 'totalFilmes', 'totalUsers'));
    }
}
