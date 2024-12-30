<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Recupera todos os papéis da tabela
        $roles = Role::paginate(20); // Paginação de 10 papéis por página

        // Retorna a view com os dados
        //return view('app.adm.usuarios.delete', compact('user'));
        return view('app.adm.roles.index', compact('roles'));
    }
    public function create()
    {
        return view('app.adm.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web' // Defina o valor padrão para guard_name

                //O campo guard_name é obrigatório na tabela roles porque o pacote Spatie Laravel Permission usa guards para diferenciar permissões e papéis entre diferentes contextos, como web e api.

                //Definimos o valor como web, que é o guard padrão usado na maioria dos casos para autenticação de usuários.
        ]);

        return redirect()->route('roles.index')->with('success', 'Papel criado com sucesso!');
    }

    public function edit(Role $role)
    {
        return view('app.adm.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Papel atualizado com sucesso!');
    }

    public function destroy(Role $role)
    {
        try {
            // Exclui o papel do banco de dados
            $role->delete();
    
            // Redireciona com mensagem de sucesso
            return redirect()->route('roles.index')->with('success', 'Papel excluído com sucesso!');
        } catch (\Exception $e) {
            // Retorna erro, caso algo dê errado
            return redirect()->route('roles.index')->with('error', 'Erro ao excluir o papel. Tente novamente.');
        }
    }
}
