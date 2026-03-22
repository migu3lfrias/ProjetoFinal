<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function adminList(Request $request)
    {
        $query = User::query();

        // Pesquisa por Nome OU Email
        $query->when($request->search, function ($q, $search) {
            return $q->where(function ($subQ) use ($search) {
                $subQ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        });

        // Filtro pelo user_type (0 ou 1)
        // Usamos filled() aqui porque o tipo 0 é considerado "falso" no PHP,
        // então filled() garante que ele apanha mesmo quando filtras por 0.
        $query->when($request->filled('user_type'), function ($q) use ($request) {
            return $q->where('user_type', $request->user_type);
        });

        $users = $query->get();

        return view('admin.users.list', compact('users'));
    }


    public function create() {
        return view('admin.users.form');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'foto' => 'nullable|image'
        ]);

        $foto = null;
        if($request->hasFile('foto')){
            $foto = $request->file('foto')->store('users', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptação!
            'foto' => $foto
        ]);

        return redirect()->route('admin.users.list')->with('sucesso', 'Utilizador criado!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image'
        ]);

        $foto = $user->foto;
        if($request->hasFile('foto')){
            $foto = $request->file('foto')->store('users', 'public');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->foto = $foto;
        $user->save();

        return redirect()->route('admin.users.list')->with('sucesso', 'Utilizador atualizado!');
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.list')->with('sucesso', 'Utilizador removido!');
    }

    public function perfil()
{
    // Retorna a vista do perfil
    return view('users.perfil');
}

public function atualizarPerfil(Request $request)
{
    // 1. Vai buscar o utilizador que está logado
    $user = Auth::user();

    // 2. Valida os dados (garante que o email não é de outra pessoa)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
    ]);

    // 3. Atualiza texto
    $user->name = $request->name;
    $user->email = $request->email;

    // 4. Lógica do Upload da Foto
    if ($request->hasFile('foto')) {
        // Se ele já tinha uma foto antiga, apagamos para não encher o servidor
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        // Guarda a nova foto na pasta 'storage/app/public/fotos_perfil'
        $path = $request->file('foto')->store('fotos_perfil', 'public');
        $user->foto = $path;
    }

    $user->save();

    return back()->with('status', 'Perfil atualizado com sucesso!');
}
}
