@echo off
title saludo-app - Practica 4
cd /d "%~dp0"
echo ============================================
echo   saludo-app (Practica 4 - Stitch + Laravel)
echo ============================================
set "PHP=php"
where php >nul 2>nul
if errorlevel 1 (
  if exist "C:\xampp\php\php.exe" (
    set "PHP=C:\xampp\php\php.exe"
  ) else (
    echo No se encontro PHP. Instala PHP 8.3 o mas reciente.
    pause
    exit /b 1
  )
)
if not exist "vendor\autoload.php" (
  echo Instalando dependencias con Composer...
  call composer install --no-interaction
  if not exist "vendor\autoload.php" (
    echo Falta Composer. Instalalo desde https://getcomposer.org y vuelve a abrir este archivo.
    pause
    exit /b 1
  )
)
if not exist ".env" (
  copy ".env.example" ".env" >nul
  "%PHP%" artisan key:generate
)
if not exist "database\database.sqlite" type nul > "database\database.sqlite"
if exist "public\hot" del "public\hot"
"%PHP%" artisan migrate --force
start "" /b cmd /c "timeout /t 4 /nobreak >nul && start http://127.0.0.1:8000/usuarios"
echo.
echo Servidor en http://127.0.0.1:8000/usuarios
echo Para detenerlo cierra esta ventana.
echo.
"%PHP%" artisan serve --host=127.0.0.1 --port=8000
pause
