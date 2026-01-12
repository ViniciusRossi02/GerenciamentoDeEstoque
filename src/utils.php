<?php 

function dump(mixed $dados):void
{
    echo "<pre>";
    var_dump($dados);
    echo "</prev>";
}
function sanitizar(mixed $entrada, string $tipo = 'texto'): mixed
{
    switch($tipo){
        case 'inteiro':
            return (INT )filter_var($entrada, FILTER_SANITIZE_NUMBER_INT);
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