<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $query->when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");

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

        if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }

        $query = Estudio::query();

        $query->when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        });

        $estudios = $query->get();

        return view('admin.estudios.list', compact('estudios'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        return view('admin.estudios.form');
    }

    public function store(Request $request)
    {

    if (!Auth::user()->isAdmin()) {
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

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $estudio = Estudio::findOrFail($id);
        return view('admin.estudios.form', compact('estudio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable'
        ]);

        $estudio = Estudio::findOrFail($id);

        if ($request->hasFile('logo')) {
            // Apaga logo anterior se existir
            if ($estudio->logo) {
                Storage::disk('public')->delete($estudio->logo);
            }
            $estudio->logo = $request->file('logo')->store('estudios', 'public');
        }

        $estudio->update([
            'name' => $request->name,
            'logo' => $estudio->logo
        ]);

        return redirect()->route('admin.estudios.list')->with('sucesso', 'Estúdio atualizado!');
    }

    public function destroy($id)
    {

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }

        //Não permite eleminar estudios que tem filmes
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
