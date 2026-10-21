<?php

namespace App\Support;

/**
 * Mensajes de validación en español para los formularios de usuarios
 * (el proyecto está en APP_LOCALE=en).
 */
class Validacion
{
    public static function mensajes(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'Escribe un correo electrónico válido.',
            'unique' => 'Ese :attribute ya está registrado.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'min' => 'La :attribute debe tener al menos :min caracteres.',
            'confirmed' => 'Las contraseñas no coinciden.',
        ];
    }

    public static function atributos(): array
    {
        return [
            'name' => 'nombre',
            'email' => 'correo',
            'password' => 'contraseña',
        ];
    }
}
