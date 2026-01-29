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
    if (!empty($busca)) {
        // Aqui apos a pessoa fazer a busca da palavra, era verifica se tem a palavra no nome do produto ou na descrição 
        $sql .= " WHERE produtos.nome LIKE :busca OR produtos.descricao LIKE :busca";
        $parametros[':busca'] = "%$busca%";
    }

    $sql .= " ORDER BY produtos.id DESC";

    $consulta = $conexao->prepare($sql);
    $consulta->execute($parametros);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// SECTION 19 - INSERIR PRODUTOS E DETALHES DOS PRODUTOS (2 SESSÕES POR SEREM 2 TABELAS DIFERENTES)

function inserirProduto(PDO $conexao, array $produto): int
{
    $sql = 'INSERT INTO produtos (nome, descricao, preco, quantidade, fornecedor_id)
            VALUES (:nome, :descricao, :preco, :quantidade, :fornecedor_id)';

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":nome", $produto['nome'], PDO::PARAM_STR);
    $consulta->bindValue(":descricao", $produto['descricao'], is_null($produto['descricao']) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $consulta->bindValue(":preco", $produto['preco'], PDO::PARAM_STR);
    $consulta->bindValue(":quantidade", $produto['quantidade'], PDO::PARAM_INT);
    $consulta->bindValue(":fornecedor_id", $produto['fornecedor_id'], PDO::PARAM_INT);

    $consulta->execute();

    // SECTION 19 - 3° PASSO - PEGAR O ID DO ULTIMO PRODUTO INSERIDO
    return (int) $conexao->lastInsertId();
}

function inserirDetalhesDoProduto(PDO $conexao, array $detalhes): void
{
    $sql = 'INSERT INTO detalhes_produto (produto_id, peso, dimensoes, codigo_barras, data_validade)
            VALUES (:produto_id, :peso, :dimensoes, :codigo_barras, :data_validade)';

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":produto_id", $detalhes['produto_id'], PDO::PARAM_INT);
    $consulta->bindValue(":peso", $detalhes['peso'], is_null($detalhes['peso']) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $consulta->bindValue(":dimensoes", $detalhes['dimensoes'], is_null($detalhes['dimensoes']) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $consulta->bindValue(":codigo_barras", $detalhes['codigo_barras'], is_null($detalhes['codigo_barras']) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $consulta->bindValue(":data_validade", $detalhes['data_validade'], is_null($detalhes['data_validade']) ? PDO::PARAM_NULL : PDO::PARAM_STR);


    $consulta->execute();
}

// <!--  SECTION 20 1° PASSO - FUNÇÃO PARA BUSCAR PRODUTO PELO ID  -->

function buscarProdutoPorId(PDO $conexao, int $id): ?array{
    $sql = "SELECT 
                produtos.id AS produto_id,
                produtos.nome,
                produtos.descricao,
                produtos.preco,
                produtos.quantidade, 
                fornecedores.id AS fornecedor_id,
                detalhes_produto.id AS detalhe_id,
                detalhes_produto.data_validade,
                detalhes_produto.peso,
                detalhes_produto.dimensoes,
                detalhes_produto.codigo_barras
                FROM produtos
                LEFT JOIN fornecedores ON produtos.fornecedor_id = fornecedores.id
                LEFT JOIN detalhes_produto ON produtos.id = detalhes_produto.produto_id
                WHERE produtos.id = :id";

                $consulta = $conexao->prepare($sql);
                $consulta->bindValue(':id', $id, PDO::PARAM_INT);
                $consulta->execute();
                return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
              
}