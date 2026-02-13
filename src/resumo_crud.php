<?php


// SECTION 26 - 1° PASSO - incluir funções para coletar os dados e inserir na pasta INDEX.PHP (pg principal) 



// query -> comando de execução simples e direto, util quando não há parametros 
// ou valores externos(ou seja, sem necessidade de prepare, bindValue, definição de PDO type)

// fetchColumn -> comando que pega o valor da primeira coluna da primeira linha do resultado
// ou seja, sem necessidade de se criar um array associativo
function contarProdutos(PDO $conexao): int
{
    $sql = "SELECT COUNT(*) FROM produtos";
    return (int) $conexao -> query($sql)->fetchColumn(); //RETORNA UMA STRING, COMO PRECAUÇÃO FORÇAMOS O RETORNO (INT) 
}

function contarFornecedores(PDO $conexao): int 
{
 $sql = "SELECT COUNT(*) FROM fornecedores";
 return (int) $conexao -> query($sql) ->fetchColumn();
}

function contarLojas(PDO $conexao): int{
    $sql = "SELECT COUNT(*) FROM lojas";
    return (int) $conexao->query($sql)->fetchColumn();
} 

function contarLojasSemRegistroDeEstoque(PDO $conexao):int
{
    $sql = "SELECT COUNT(*) FROM lojas 
    -- LEFT JOIN, PQ PEGA OS DADOS MESMO QUE SE ESTIVEREM APENAS DE UM LADO
    LEFT JOIN lojas_produtos
    ON lojas.id = lojas_produtos.loja_id
    WHERE lojas_produtos.loja_id IS NULL";
    return (int) $conexao->query($sql)->fetchColumn();
}

function contarEstoquesBaixo(PDO $conexao): int
{
    $sql = "SELECT COUNT(*) FROM lojas_produtos WHERE estoque < 5";
    return (int) $conexao->query($sql)->fetchColumn();
    
}

function contarProdutosVencidosOuVencendo(PDO $conexao): int{
    $sql = "SELECT COUNT(*) FROM detalhes_produto
            WHERE 
                data_validade IS NOT NULL 
                -- <= MENOR IGUAL 30 DIAS ANTES DA VALIDADE
             AND data_validade <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
    return (int) $conexao->query($sql)->fetchColumn();
}