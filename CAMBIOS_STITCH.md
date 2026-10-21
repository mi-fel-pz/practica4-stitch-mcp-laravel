# Práctica 4 · Vistas de Google Stitch en saludo-app

El maestro pidió: conectar el MCP de Stitch al editor (VS Code) y generar con Stitch
**listado de usuarios**, **registro de usuarios** y **editar perfil** sobre el proyecto con el que trabajamos.

## 1. MCP de Stitch
`.vscode/mcp.json` ya está en este proyecto. En VS Code:
1. Abre la carpeta `saludo-app` (Archivo → Abrir carpeta).
2. Abre `.vscode/mcp.json` y haz clic en **Start** sobre `stitch`; pega tu API key (stitch.withgoogle.com/settings).
3. Abre el chat de Copilot (Ctrl+Alt+I), elige el modo **Agent** y verifica que las herramientas de `stitch` están activas.

## 2. Vistas
| Vista | Ruta | Archivo |
|---|---|---|
| Listado de usuarios | `GET /usuarios` | `resources/views/usuarios/index.blade.php` |
| Registro de usuario | `GET /usuarios/registro` | `resources/views/usuarios/registro.blade.php` |
| Editar perfil | `GET /usuarios/{id}/editar` | `resources/views/usuarios/editar.blade.php` |

Controlador: `app/Http/Controllers/UsuarioController.php` (index, create, store, edit, update) sobre la tabla `users`.
Layout: `resources/views/layouts/app.blade.php` (head, fuentes y `@vite`); las 3 vistas usan `@extends('layouts.app')` y `@section('content')`.
Imágenes: el logo está en `public/images/logo-saludo.svg` y se usa con `asset('images/logo-saludo.svg')`.
Diseño: sistema "Warm Architectural Craft" del proyecto de Stitch (colores y tipografías en el `@theme` de `resources/css/app.css`).
Componentes reutilizables: `resources/views/components/ui/*` y `resources/views/components/layout/*`.

## 3. Archivos modificados (originales en `_respaldo_antes_de_stitch/`)
- `routes/web.php`: se agregaron las 5 rutas de usuarios (la ruta `/saludo` sigue igual).
- `resources/css/app.css`: tema de Stitch.
- `resources/js/app.js`: importa `ui.js` (modo noche, avisos, atajo Ctrl+K).

## 4. Probar
```
npm install
npm run dev
```
En otra terminal:
```
php artisan serve
```
Abre http://127.0.0.1:8000/usuarios
