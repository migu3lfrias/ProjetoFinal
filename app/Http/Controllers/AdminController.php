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
        //Futuro passar isso para uma função ou mudar para o jeito usado em aula
        if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }

        $totalEstudios = Estudio::count();
        $totalFilmes = Filme::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalEstudios', 'totalFilmes', 'totalUsers'));
    }
}
