<!-- Arquivo de gerenciamento CRUD do usuario -->

<?php
// usuario_crud.php

function buscarUsuarios(PDO $conexao): array
{
    $sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
