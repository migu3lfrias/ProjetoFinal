<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudioController extends Controller
{
    public function home()
    {
        $filmes = Filme::all()->take(3);
        $estudios = Estudio::all()->take(3);
        return view('homepage', compact('estudios', 'filmes'));
    }

    public function list(Request $request)
{
    $query = Estudio::query();

    $query->when($request->search, function ($q, $search) {
        return $q->where('nome', 'like', "%{$search}%");

    });

    $query->when($request->ordem, function ($q, $ordem) {
        if ($ordem === 'az') return $q->orderBy('nome', 'asc');
        if ($ordem === 'za') return $q->orderBy('nome', 'desc');
        return $q;
    });

    $estudios = $query->get();

    return view('estudios.list', compact('estudios'));
}

    public function show($id)
    {
        $estudio = Estudio::with('filmes')->findOrFail($id);

        return view('estudios.show', compact('estudio'));
    }

    public function adminList(Request $request)
    {

        if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }

        $query = Estudio::query();

        $query->when($request->search, function ($q, $search) {
            return $q->where('nome', 'like', "%{$search}%");
        });

        $query->when($request->ordem, function ($q, $ordem) {
            if ($ordem === 'az') return $q->orderBy('nome', 'asc');
            if ($ordem === 'za') return $q->orderBy('nome', 'desc');
            return $q;
        });

        $estudios = $query->get();

        return view('admin.estudios.list', compact('estudios'));
    }

    public function create()
    {
        if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        return view('admin.estudios.form');
    }

    public function store(Request $request)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable',
        ]);

        $logo = null;
        if($request->hasFile('logo')){
            $logo = $request->file('logo')->store('estudios', 'public');
        }

        Estudio::create([
            'name' => $request->name,
            'logo' => $logo
        ]);

        return redirect()->route('admin.estudios.list')->with('sucesso', 'Estúdio criado com sucesso!');
    }

    public function edit($id)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $estudio = Estudio::findOrFail($id);
        return view('admin.estudios.form', compact('estudio'));
    }

    public function update(Request $request, $id)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image'
        ]);

        $estudio = Estudio::findOrFail($id);
        $logo = $estudio->logo;

        if($request->hasFile('logo')){
            $logo = $request->file('logo')->store('estudios', 'public');
        }

        $estudio->update([
            'name' => $request->name,
            'logo' => $logo
        ]);

        return redirect()->route('admin.estudios.list')->with('sucesso', 'Estúdio atualizado!');
    }

    public function destroy($id)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $estudio = Estudio::findOrFail($id);
        if ($estudio->filmes()->count() > 0) {
            return redirect()->route('admin.estudios.list')
                ->with('erro', 'Não é possível apagar este estúdio porque tem ' . $estudio->filmes()->count() . ' filme(s) associado(s). Apague os filmes primeiro.');
        }

        $estudio->delete();

        return redirect()->route('admin.estudios.list')
            ->with('sucesso', 'Estúdio apagado com sucesso!');
    }
}
