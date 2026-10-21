# Práctica 4: Google Stitch MCP en VS Code + Laravel

Proyecto `saludo-app` (Laravel 13, SQLite) con:

- **MCP de Google Stitch en VS Code**: `.vscode/mcp.json` (la API key se pide al iniciar el servidor y no queda escrita en el archivo).
- **Tres interfaces diseñadas en Stitch** y convertidas a Blade:

| Interfaz | Ruta | Vista |
|---|---|---|
| Registro de usuario | `GET /usuarios/registro` | `resources/views/usuarios/registro.blade.php` |
| Listar usuarios | `GET /usuarios` | `resources/views/usuarios/index.blade.php` |
| Editar perfil | `GET /usuarios/{id}/editar` | `resources/views/usuarios/editar.blade.php` |

Controlador: `app/Http/Controllers/UsuarioController.php` · Layout: `resources/views/layouts/app.blade.php` · Componentes: `resources/views/components/` · Colores de Stitch: `resources/css/app.css`.

Reporte con evidencias: [`docs/Practica4_Stitch_MCP.pdf`](docs/Practica4_Stitch_MCP.pdf)

## Cómo ejecutarlo

En Windows: doble clic en `iniciar.bat` (instala dependencias con Composer si faltan, crea la base de datos y abre http://127.0.0.1:8000/usuarios).

Manual:

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Los estilos ya están compilados en `public/build`; para editarlos: `npm install` y `npm run dev`.

---

# Manual Técnico - Aplicación de Saludo

## Descripción del Proyecto

Esta es una aplicación Laravel sencilla que muestra un mensaje de saludo en la ruta `/saludo`. El proyecto demuestra la estructura básica de MVC (Modelo-Vista-Controlador) en Laravel: un controlador que prepara los datos y una vista Blade que los renderiza.

## Estructura de Archivos Relevantes

```
saludo-app/
├── app/
│   └── Http/
│       └── Controllers/
│           └── SaludoController.php    # Controlador que maneja la lógica del saludo
├── resources/
│   └── views/
│       └── saludo.blade.php            # Vista Blade que muestra el mensaje
└── routes/
    └── web.php                         # Definición de rutas web
```

### Detalle de Archivos

**`app/Http/Controllers/SaludoController.php`**
- Controlador que extiende `Controller` base de Laravel
- Método `index()`: define la variable `$mensaje` con el texto "Hola, este saludo viene del SaludoController" y retorna la vista `saludo` pasándole dicha variable

**`resources/views/saludo.blade.php`**
- Plantilla HTML5 básica con idioma español
- Muestra la variable `$mensaje` dentro de una etiqueta `<h1>` usando la sintaxis Blade `{{ $mensaje }}`

**`routes/web.php`**
- Ruta `GET /`: retorna la vista por defecto `welcome` de Laravel
- Ruta `GET /saludo`: mapea al método `index` de `SaludoController`

## Requisitos

- PHP >= 8.1
- Composer
- Extensiones PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath
- Laravel Framework (instalado vía Composer)

## Instalación

1. Clonar o descargar el proyecto
2. Navegar al directorio del proyecto:
   ```bash
   cd saludo-app
   ```
3. Instalar dependencias de PHP:
   ```bash
   composer install
   ```
4. Copiar el archivo de entorno de ejemplo y generar la clave de aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

## Cómo Levantar el Servidor

Ejecutar el servidor de desarrollo integrado de Laravel:

```bash
php artisan serve
```

Por defecto, el servidor estará disponible en `http://127.0.0.1:8000`.

## Acceso a la Ruta /saludo

Una vez el servidor esté en marcha, acceder en el navegador a:

```
http://127.0.0.1:8000/saludo
```

Se mostrará una página con el encabezado:

> **Hola, este saludo viene del SaludoController**

La ruta raíz (`/`) muestra la página de bienvenida por defecto de Laravel.