 <?php

     // SECTION 24 - 1° PASSO - LINKAR ARQUIVOS NECESSÁRIOS 
    require_once __DIR__ ."/../config.php";
    require_once BASE_PATH ."/src/estoque_crud.php";
    require_once BASE_PATH ."/src/utils.php";
     
    exigirLogin();

     // SECTION 24 - 2° PASSO - CRIAR VARIAVEL DE ERRO E VARIAVEL PARA RECEBER OS DADOS
    $erro = null;
    $estoques = [];

     // SECTION 24 - 3° PASSO - FAZER A FUNÇÃO DE BUSCA E TRATAR POSSIVEIS ERROS
    try {
     $estoques = buscarEstoques($conexao);
    } catch (Throwable $e) {
    $erro = "Erro ao buscar os estoques. <br>" . $e->getMessage();
    }

    

    $titulo = "Estoque |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-stack"></i> Estoque das lojas</h3>

     <!-- // SECTION 24 - 4° PASSO - EXIBIR MENSAGEM DE ERRO -->
      <?php if ($erro): ?>
           <p class="alert alert-danger text-center">
                <?= $erro ?>
           </p>
      <?php endif; ?>

     <p>
          <a class="btn btn-primary" href="inserir.php">
              <i class="bi bi-plus-circle"></i>  Novo Registro de estoque
          </a>
     </p>

     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
               <caption>Quantidade de resgistros: <?= count($estoques) ?></caption>
               <thead class="align-middle table-light">
                    <tr>
                         <th>Loja</th>
                         <th>Produto</th>
                         <th>Quantidade</th>
                         <th colspan="2">Ações</th>
                    </tr>
               </thead>
               <tbody>
                <!-- // SECTION 24 - 5° PASSO - TABELA DINAMICA -->    
               <?php foreach($estoques as $estoque): ?>
                    <tr>
                         <td><?= $estoque['nome_loja'] ?></td>
                         <td><?= $estoque['nome_produto'] ?></td>
                         <td><?= $estoque['estoque'] ?></td>
               <!-- // SECTION 24 - 6° PASSO - LINKS PARA EDICAO E EXCLUSÃO -->  
                         <td><a class="btn btn-warning btn-sm" href="editar.php?loja_id=<?= $estoque['loja_id'] ?>&produto_id=<?= $estoque['produto_id'] ?>"><i class="bi bi-pencil-square"></i> Editar</a></td>
                         <td><a class="btn btn-danger btn-sm" href="excluir.php?editar.php?loja_id=<?= $estoque['loja_id'] ?>&produto_id=<?= $estoque['produto_id'] ?>"><i class="bi bi-trash"></i> Excluir</a></td>
                    </tr>
                    <?php endforeach; ?>
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>