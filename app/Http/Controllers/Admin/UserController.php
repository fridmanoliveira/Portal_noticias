<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'role:master']); // Apenas master acessa
    }

    // Lista de usuários
    public function index()
    {
        $users = User::all()->map(function ($user) {
            $user->load('roles');
            $user->permissions_list = $user->getAllPermissions()->pluck('name'); // adiciona permissões herdadas
            return $user;
        });// Carrega roles e permissões
        return view('admin.usuarios.index', compact('users'));
    }

    // Formulário de criação
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.usuarios.create', compact('roles', 'permissions'));
    }

    // Armazenar novo usuário
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sincronizar Roles e Permissões
        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    // Formulário de edição
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.usuarios.edit', compact('user', 'roles', 'permissions'));
    }

    // Atualizar usuário
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sincronizar Roles e Permissões
        $user->syncRoles($request->roles ?? []);
        $user->syncPermissions($request->permissions ?? []);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Excluir usuário
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuário removido com sucesso!');
    }
}
