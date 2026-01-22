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
                return trim(filter_var($entrada, FILTER_SANITIZE_EMAIL));
        
        case 'texto':
            default:
                return trim(filter_var($entrada, FILTER_SANITIZE_SPECIAL_CHARS));
    }
};



function codificarSenha(string $senha): string
{
    // retorna o hash da senha
    return password_hash($senha, PASSWORD_DEFAULT);
}

//  Função que compara a senha digitada com a do banco
function verificarSenha(string $senhaForm, string $senhaBanco): string
{
    // Se a senha digitada for a mesma, ela retorna TRUE e falamaos para ela manter a do banco (da no mesmo)
    if(password_verify($senhaForm, $senhaBanco)){
            return $senhaBanco;
    // Acontece se a der FALSE (A senha for diferente da do banco e voce quiser mesmo trocar ela)    
    }else{
            return codificarSenha($senhaForm);
    }
}