<?php 

function sanitizar(mixed $entrada, string $tipo = 'texto'): mixed
{
    switch($tipo){
        case 'email':
                return filter_var($entrada, FILTER_SANITIZE_EMAIL);
        
        case 'texto':
            default:
                return filter_var($entrada, FILTER_SANITIZE_SPECIAL_CHARS);
    }
};



function codificarSenha(string $senha): string
{
    // retorna o hash da senha
    return password_hash($senha, PASSWORD_DEFAULT);
}