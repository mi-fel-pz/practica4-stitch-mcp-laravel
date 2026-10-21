<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Validacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Práctica 4: vistas generadas con Google Stitch (MCP) y aplicadas en Laravel.
 *  - Listado de usuarios:   usuarios/index.blade.php
 *  - Registro de usuario:   usuarios/registro.blade.php
 *  - Editar perfil:         usuarios/editar.blade.php
 */
class UsuarioController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->query('q', ''));

        $usuarios = User::query()
            ->when($buscar !== '', function ($consulta) use ($buscar) {
                $consulta->where(fn ($c) => $c
                    ->where('name', 'like', "%{$buscar}%")
                    ->orWhere('email', 'like', "%{$buscar}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('usuarios.index', [
            'usuarios' => $usuarios,
            'buscar' => $buscar,
            'totales' => [
                'usuarios' => User::count(),
                'semana' => User::where('created_at', '>=', now()->subDays(7))->count(),
                'hoy' => User::whereDate('created_at', today())->count(),
            ],
            'ultimo' => User::latest()->first(),
        ]);
    }

    public function create(): View
    {
        return view('usuarios.registro');
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], Validacion::mensajes(), Validacion::atributos());

        // El modelo User encripta la contraseña ('password' => 'hashed' en casts()).
        $usuario = User::create($datos);

        return redirect()->route('usuarios.index')
            ->with('status', "Usuario {$usuario->name} registrado")
            ->with('status_icon', 'person_add');
    }

    public function edit(User $usuario): View
    {
        return view('usuarios.editar', ['usuario' => $usuario]);
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], Validacion::mensajes(), Validacion::atributos());

        $usuario->name = $datos['name'];
        $usuario->email = $datos['email'];
        if (! empty($datos['password'])) {
            $usuario->password = $datos['password'];
        }
        $usuario->save();

        return redirect()->route('usuarios.editar', $usuario)->with('status', 'Perfil actualizado');
    }
}
