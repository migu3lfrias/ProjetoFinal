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

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $query = User::query();

        // Pesquisa por Nome OU Email
        $query->when($request->search, function ($q, $search) {
            return $q->where(function ($subQ) use ($search) {
                $subQ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        });


        $query->when($request->filled('user_type'), function ($q) use ($request) {
            return $q->where('user_type', $request->user_type);
        });

        $users = $query->get();

        return view('admin.users.list', compact('users'));
    }


    public function create() {

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        return view('admin.users.form');
    }

    public function store(Request $request) {

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
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
            'password' => Hash::make($request->password),
            'foto' => $foto
        ]);

        return redirect()->route('admin.users.list')->with('sucesso', 'Utilizador criado!');
    }

    public function edit($id) {

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        $user = User::findOrFail($id);
        return view('admin.users.form', compact('user'));
    }

    //Alterar a forma de guardar foto
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Só atualiza foto se enviou uma nova

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = $request->file('foto')->store('users', 'public');
        }

        $user->save();

        return redirect()->route('admin.users.list')->with('sucesso', 'Utilizador atualizado!');
    }

    public function destroy($id) {

    if (!Auth::user()->isAdmin()) {
        return redirect('/')->with('error', 'Acesso negado. Apenas administradores.');
    }
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.list')->with('sucesso', 'Utilizador removido!');
    }

    public function perfil()
    {
        return view('users.perfil');
    }

    public function atualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required' . $user->id,
            'foto' => 'nullable',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        //Se é adionado foto apaga a anterior
            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    Storage::disk('public')->delete($user->foto);
                }
            $user->foto = $request->file('foto')->store('fotos_perfil', 'public');
        }

        $user->save();

        return back()->with('status', 'Perfil atualizado com sucesso!');
    }
}
