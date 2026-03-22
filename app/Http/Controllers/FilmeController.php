<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    // Mostra a página com TODOS os filmes do site

    public function list(Request $request)
    {
        // Vai buscar todos os filmes e carrega a relação com o estúdio
        $query = Filme::query();

    // 1. Pesquisa por Nome (se a variável 'search' existir no URL)
    $query->when($request->search, function ($q, $search) {
        return $q->where('titulo', 'like', "%{$search}%");
        // Nota: Substitui 'titulo' pelo nome exato da tua coluna na base de dados (ex: 'nome')
    });

    // 2. Filtro por Género
    $query->when($request->genero, function ($q, $genero) {
        return $q->where('genero', $genero);
    });

    // Executa a query. (Se quiseres usar paginação, troca o get() por paginate(10) !)
    $filmes = $query->get();

    return view('filmes.list', compact('filmes'));
    }

    public function show($id)
    {

    $filme = Filme::with('estudio')->findOrFail($id);

        return view('filmes.show', compact('filme'));
    }

    // Mostra a lista de Filmes no Backoffice
    public function adminList(Request $request)
{
    // 1. Iniciamos a query já a carregar o estúdio (para não perderes essa ligação)
    $query = Filme::with('estudio');

    // 2. Filtro de Pesquisa por texto (Ex: título do filme)
    // NOTA: Se a tua coluna na BD se chamar 'nome' em vez de 'titulo', altera ali em baixo!
    $query->when($request->search, function ($q, $search) {
        return $q->where('titulo', 'like', "%{$search}%");
    });

    // 3. Filtro por dropdown (Ex: Género)
    $query->when($request->genero, function ($q, $genero) {
        return $q->where('genero', $genero);
    });

    // 4. Finalmente, executamos a query e vamos buscar os resultados
    $filmes = $query->get();

    return view('admin.filmes.list', compact('filmes'));
}

    // Mostra o formulário para criar
    public function create()
    {
        // Precisamos de enviar todos os estúdios para preencher a caixa de seleção (dropdown)
        $estudios = Estudio::all();
        return view('admin.filmes.form', compact('estudios'));
    }

    // Guarda o filme novo
    public function store(Request $request)
    {
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

    // Mostra o formulário preenchido para editar
    public function edit($id)
    {
        $filme = Filme::findOrFail($id);
        $estudios = Estudio::all(); // Precisamos dos estúdios aqui também!

        return view('admin.filmes.form', compact('filme', 'estudios'));
    }

    // Atualiza o filme
    public function update(Request $request, $id)
    {
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

    // Apaga o filme
    public function destroy($id)
    {
        $filme = Filme::findOrFail($id);
        $filme->delete();

        return redirect()->route('admin.filmes.list')->with('sucesso', 'Filme apagado do catálogo!');
    }
}
