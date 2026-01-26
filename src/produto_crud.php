<!--  SECTION 17 - 1° CRIAR CONEXAO COMO BANCO DE PRODUTOS -->

<?php

//  <!--  SECTION  9° PARA RELACIONAR TABELAS DIFERENTER PRECISA ALTERAR UM POOUCO A FUNÇÃO BUSCARPRODUTOS  -->

function buscarProdutos(PDO $conexao, string $busca = ''): array
{
    $sql = "SELECT
                produtos.id, produtos.nome, produtos.descricao, produtos.preco,
                fornecedores.nome AS fornecedor, 
                detalhes_produto.data_validade
             FROM produtos
             LEFT JOIN fornecedores ON produtos.fornecedor_id = fornecedores.id   
             LEFT JOIN detalhes_produto ON detalhes_produto.produto_id = produtos.id";

    $parametros = [];

    // usando parametros nomeados para dizer ao sql que ele vai ser vinculado ao :busca
    if(!empty($busca)){
        // Aqui apos a pessoa fazer a busca da palavra, era verifica se tem a palavra no nome do produto ou na descrição 
        $sql .= " WHERE produtos.nome LIKE :busca OR produtos.descricao LIKE :busca";
        $parametros[':busca'] = "%$busca%";
    }

    $sql .= " ORDER BY produtos.id DESC";

    $consulta = $conexao->prepare($sql);
    $consulta->execute($parametros);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

