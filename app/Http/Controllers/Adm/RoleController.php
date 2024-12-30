<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    public function permissions(Role $role)
    {
        $permissions = Permission::all(); // Todas as permissões disponíveis
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Permissões já atribuídas ao papel

        return view('app.adm.roles.permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'array', // Deve ser um array de permissões
            'permissions.*' => 'exists:permissions,name', // Cada permissão deve existir na tabela permissions
        ]);

        $permissionNames = $validated['permissions'] ?? [];

        // Recupera as permissões atuais da role
        $currentPermissions = $role->permissions->pluck('name')->toArray();

        // Adiciona as permissões que não estão associadas
        foreach ($permissionNames as $permissionName) {
            if (!in_array($permissionName, $currentPermissions)) {
                $role->givePermissionTo($permissionName);
            }
        }

        // Remove as permissões que foram desmarcadas
        foreach ($currentPermissions as $currentPermission) {
            if (!in_array($currentPermission, $permissionNames)) {
                $role->revokePermissionTo($currentPermission);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Permissões atualizadas com sucesso!');
    }
}
