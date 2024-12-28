<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todos os usuários do banco de dados
        $users = User::all();

        // Passa os usuários  para a view.
        return view('app.adm.usuarios.consulta', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.adm.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validação dos dados
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'ativo' => 'required|boolean',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string válida.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, forneça um e-mail válido.',
            'email.unique' => 'Este e-mail já está registrado. Tente outro.',
        
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        
            'ativo.required' => 'O campo ativo é obrigatório.',
            'ativo.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
        ]);

        // Criação do usuário
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash da senha
            'ativo' => $validated['ativo'],
        ]);

        // Redireciona para a lista de usuários com mensagem de sucesso
        return redirect()->route('usuario.consulta')->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
