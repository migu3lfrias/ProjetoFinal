<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmeController extends Controller
{

    public function list(Request $request)
    {
        $query = Filme::query();

    $query->when($request->search, function ($q, $search) {
        return $q->where('titulo', 'like', "%{$search}%");
    });

    $query->when($request->genero, function ($q, $genero) {
        return $q->where('genero', $genero);
    });
    $filmes = $query->get();

    return view('filmes.list', compact('filmes'));
    }

    public function show($id)
    {

    $filme = Filme::with('estudio')->findOrFail($id);

        return view('filmes.show', compact('filme'));
    }

    public function adminList(Request $request)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $query = Filme::with('estudio');

        $query->when($request->search, function ($q, $search) {
            return $q->where('titulo', 'like', "%{$search}%");
        });

        $query->when($request->genero, function ($q, $genero) {
            return $q->where('genero', $genero);
        });

        $filmes = $query->get();

        return view('admin.filmes.list', compact('filmes'));
    }

    public function create()
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $estudios = Estudio::all();
        return view('admin.filmes.form', compact('estudios'));
    }

    public function store(Request $request)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $request->validate([
            'titulo' => 'required|string|max:255',
            'estudio_id' => 'required|exists:estudios,id',
            'genero' => 'required|string|max:100',
            'data_lancamento' => 'required|date',
            'capa' => 'nullable'
        ]);

        $capa = null;
        if($request->hasFile('capa')){
            $capa = $request->file('capa')->store('filmes', 'public');
        }

        Filme::create([
            'titulo' => $request->titulo,
            'estudio_id' => $request->estudio_id,
            'genero' => $request->genero,
            'data_lancamento' => $request->data_lancamento,
            'capa' => $capa
        ]);

        return redirect()->route('admin.filmes.list')->with('sucesso', 'Filme adicionado ao catálogo com sucesso!');
    }

    public function edit($id)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $filme = Filme::findOrFail($id);
        $estudios = Estudio::all();

        return view('admin.filmes.form', compact('filme', 'estudios'));
    }

    public function update(Request $request, $id)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $request->validate([
            'titulo' => 'required|string|max:255',
            'estudio_id' => 'required|exists:estudios,id',
            'genero' => 'required|string|max:100',
            'data_lancamento' => 'required|date',
            'capa' => 'nullable|image'
        ]);

        $filme = Filme::findOrFail($id);

        $capa = $filme->capa;

        if($request->hasFile('capa')){
            $capa = $request->file('capa')->store('filmes', 'public');
        }

        $filme->update([
            'titulo' => $request->titulo,
            'estudio_id' => $request->estudio_id,
            'genero' => $request->genero,
            'data_lancamento' => $request->data_lancamento,
            'capa' => $capa
        ]);

        return redirect()->route('admin.filmes.list')->with('sucesso', 'Filme atualizado com sucesso!');
    }

    public function destroy($id)
    {

    if (Auth::user()->user_type != 1) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $filme = Filme::findOrFail($id);
        $filme->delete();

        return redirect()->route('admin.filmes.list')->with('sucesso', 'Filme apagado do catálogo!');
    }
}
