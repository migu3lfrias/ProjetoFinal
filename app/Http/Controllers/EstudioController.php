<?php

namespace App\Http\Controllers;

use App\Models\Estudio; // Garante que o nome do teu Model está correto
use App\Models\Filme;
use Illuminate\Http\Request;

class EstudioController extends Controller
{
    // Mostra a página principal com todos os estúdios
    public function home()
    {
        // Vai buscar todos os estúdios à base de dados
        $filmes = Filme::all()->take(3);
        $estudios = Estudio::all()->take(3);
        return view('homepage', compact('estudios', 'filmes'));
    }

    // Mostra a página de um estúdio específico e os seus filmes
    public function list(Request $request)
{
    $query = Estudio::query();

    // 1. Pesquisa por Nome do Estúdio
    $query->when($request->search, function ($q, $search) {
        return $q->where('nome', 'like', "%{$search}%");
        // Se a tua coluna na BD for 'name' em vez de 'nome', altera aqui!
    });

    // 2. Filtro de Ordenação
    $query->when($request->ordem, function ($q, $ordem) {
        if ($ordem === 'az') return $q->orderBy('nome', 'asc');
        if ($ordem === 'za') return $q->orderBy('nome', 'desc');
        return $q;
    });

    $estudios = $query->get(); // Se quiseres com paginação, usa ->paginate(10);

    return view('estudios.list', compact('estudios'));
}

    public function show($id)
    {
        // Vai buscar 1 estúdio pelo ID e traz logo os seus filmes
        $estudio = Estudio::with('filmes')->findOrFail($id);

        return view('estudios.show', compact('estudio'));
    }

    // Mostra a lista de Estúdios no Backoffice
    public function adminList(Request $request)
{
    $query = Estudio::query();

    // 1. Pesquisa por Nome
    $query->when($request->search, function ($q, $search) {
        return $q->where('nome', 'like', "%{$search}%");
    });

    // 2. Filtro de Ordenação
    $query->when($request->ordem, function ($q, $ordem) {
        if ($ordem === 'az') return $q->orderBy('nome', 'asc');
        if ($ordem === 'za') return $q->orderBy('nome', 'desc');
        return $q;
    });

    $estudios = $query->get();

    return view('admin.estudios.list', compact('estudios'));
}

    // Mostra o formulário para criar
    public function create()
    {
        return view('admin.estudios.form');
    }

    // Guarda o estúdio novo na base de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable',
        ]);

        $logo = null;
        if($request->hasFile('logo')){
            // Guarda na pasta storage/app/public/estudios
            $logo = $request->file('logo')->store('estudios', 'public');
        }

        Estudio::create([
            'name' => $request->name,
            'logo' => $logo
        ]);

        return redirect()->route('admin.estudios.list')->with('sucesso', 'Estúdio criado com sucesso!');
    }

    // Mostra o formulário preenchido para editar
    public function edit($id)
    {
        $estudio = Estudio::findOrFail($id);
        return view('admin.estudios.form', compact('estudio'));
    }

    // Atualiza o estúdio na base de dados
    public function update(Request $request, $id)
    {
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

    // Apaga o estúdio
    public function destroy($id)
    {
        $estudio = Estudio::findOrFail($id);
        if ($estudio->filmes()->count() > 0) {
            return redirect()->route('admin.estudios.list')
                ->with('erro', 'Não é possível apagar este estúdio porque tem ' . $estudio->filmes()->count() . ' filme(s) associado(s). Apague os filmes primeiro.');
        }

        // Se não tiver filmes, apaga com segurança
        $estudio->delete();

        return redirect()->route('admin.estudios.list')
            ->with('sucesso', 'Estúdio apagado com sucesso!');
    }
}
