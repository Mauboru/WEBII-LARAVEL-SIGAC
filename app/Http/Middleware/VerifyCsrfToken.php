<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware{
    protected $except = [
        "/eixo*",
        "/nivel*",
        "/curso*",
        "/permission*",
        "/turma*",
        "/categoria*",
        "/aluno*",
        "/user*",
        "/comprovante*",
        "/declaracao*",
    ];
}