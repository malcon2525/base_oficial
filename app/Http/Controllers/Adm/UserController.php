<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    public function edit($id)
    {
        // Recupera o usuário pelo ID
        $user = User::findOrFail($id);
        
        // Retorna a view com o usuário
        return view('app.adm.usuarios.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        //dd($request->input('ativo'));
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, //A validação é semelhante à de cadastro, mas a regra para o campo email permite a atualização do próprio e-mail do usuário (com a exceção do seu próprio registro usando unique:users,email,' . $id).
            'password' => 'nullable|min:6|confirmed', // A senha é atualizada apenas se o campo password for preenchido. Caso contrário, o usuário manterá a senha antiga.
            
        ]);

        // Recupera o usuário a ser atualizado
        $user = User::findOrFail($id);

        // Atualiza os dados do usuário
        $user->name = $request->input('name');
        $user->email = $request->input('email');        
        $user->ativo = $request->input('ativo') == 'on' ? true : false ;

        // Atualiza a senha apenas se foi fornecida
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Salva as alterações no banco de dados
        $user->save();

        // Redireciona de volta para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuario.consulta')->with('success', 'Usuário atualizado com sucesso!');
    }




    /**
     * Mostra o formulário para excluir um usuário.
     * 
     */
    public function showDeleteForm($id)
    {
        // Recupera o usuário a ser excluído
        $user = User::findOrFail($id);

        // Exibe a view com o usuário para confirmação
        return view('app.adm.usuarios.delete', compact('user'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Verifica se o usuário existe
        $user = User::findOrFail($id);

        // Exclui o usuário
        $user->delete();

        // Redireciona de volta para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuario.consulta')->with('success', 'Usuário excluído com sucesso!');
    }


    public function editRoles(User $user)
    {
        /// Recupera todos os papéis com suas permissões
        $roles = Role::with('permissions')->get();

        // Recupera os IDs dos papéis já atribuídos ao usuário
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('app.adm.usuarios.edit-roles', compact('user', 'roles', 'userRoles'));
    }

    public function updateRoles(Request $request, User $user)
    {
        // Validação dos dados
        $request->validate([
            'roles' => 'array', // 'roles' deve ser um array
            'roles.*' => 'exists:roles,id', // Verifica se os ids dos papéis existem
        ]);

        // Atualiza os papéis do usuário
        $user->roles()->sync($request->roles); // Sincroniza os papéis com o usuário

        return redirect()->route('users.roles.permissions.summary', ['user' => $user->id])->with('success', 'Papéis atualizados com sucesso!');
    }



    public function editPermissions(User $user)
    {
        // Recupera todas as permissões
        $permissions = Permission::all();
        
        // Recupera as permissões já associadas ao usuário
        $userPermissions = $user->permissions->pluck('id')->toArray();

        return view('app.adm.usuarios.edit-permissions', compact('user', 'permissions', 'userPermissions'));
    }

    public function updatePermissions(Request $request, User $user)
    {
         // Valida os dados recebidos
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Sincroniza as permissões com o usuário
        $user->syncPermissions($request->permissions);

        return redirect()->route('users.roles.permissions.summary', ['user' => $user->id])->with('success', 'Permissões  atualizadas com sucesso!');
    }


    public function rolesPermissionsSummary(User $user)
    {
        // Obtém os papéis associados ao usuário, carregando também as permissões de cada papel
        $roles = $user->roles()->with('permissions')->get();

        // Obtém as permissões associadas ao usuário
        $permissions = $user->permissions;

        return view('app.adm.usuarios.roles-permissions-summary', compact('user', 'roles', 'permissions'));
    }

}
