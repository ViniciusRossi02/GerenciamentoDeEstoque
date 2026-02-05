<?php

function buscarEstoques(PDO $conexao): array
{
        $sql = "SELECT 
                      lojas_produtos.loja_id,
                      lojas_produtos.produto_id,
                      lojas_produtos.estoque,
                      lojas.nome AS nome_loja,
                      produtos.nome AS nome_produto
                FROM lojas_produtos
                INNER JOIN lojas ON lojas_produtos.loja_id = lojas.id
                INNER JOIN produtos ON lojas_produtos.produto_id = produtos.id
                ORDER BY lojas.nome, produtos.nome"
                      ;
        $consulta = $conexao->query($sql);
        $consulta -> execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function inserirEstoque(PDO $conexao, int $loja_id, int $produto_id, int $estoque): void
{
        $sql = "INSERT INTO lojas_produtos (loja_id, produto_id, estoque)
                VALUES (:loja_id, :produto_id, :estoque)";
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':loja_id', $loja_id, PDO::PARAM_INT);
        $consulta->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
        $consulta->bindValue(':estoque', $estoque, PDO::PARAM_INT);
        $consulta->execute();
}