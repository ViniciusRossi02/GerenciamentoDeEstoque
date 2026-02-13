<?php 

function dump(mixed $dados):void
{
    echo "<pre>";
    var_dump($dados);
    echo "</prev>";
}

// SECTION 18  ADICIONAR SANITIZAÇÃO DE DECIMAL
function sanitizar(mixed $entrada, string $tipo = 'texto'): mixed
{
    switch($tipo){
        case 'inteiro':
            return (int)filter_var($entrada, FILTER_SANITIZE_NUMBER_INT);
        case 'decimal':
            return (float) filter_var($entrada, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
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

// <!--  SECTION 17 - 10° criar função para formatar data  -->
//  esse ? antes da stringo significa que pode ser string ou pode ser NULL 
function formatarData(?string $data):string{
    return $data ? date("d/m/y", strtotime($data)) : '-';
}

// <!--  SECTION 17 - 11° criar função para formatar preço -->

function formatarPreço(float $preco):string
{
    return "R$".number_format($preco,2,',','.');
}



function ultimaAtualização(): string
{
    // Configuração de fuso horário (timezone)

    // retorna a data em formato DIA/MÊS/ANO HORA:MINUTOS
    date_default_timezone_set("America/Sao_Paulo");
    return date("d/m/Y H:i");
}