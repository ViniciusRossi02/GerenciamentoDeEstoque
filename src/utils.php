<?php 

function codificarSenha(string $senha): string
{
    // retorna o hash da senha
    return password_hash($senha, PASSWORD_DEFAULT);
}