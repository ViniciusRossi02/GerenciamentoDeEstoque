 <?php
     // SECTION 15 - 2° PASSO - CHAMAR AS PAGINAS COM A FUNÇÃO E A UTILS
    require_once __DIR__ ."/../config.php";
    require BASE_PATH . '/src/fornecedor_crud.php';
    require_once BASE_PATH . '/src/utils.php';


     $titulo = "Fornecedores |";
    require_once BASE_PATH ."/includes/cabecalho.php";

    exigirLogin();
// SECTION 15 - 3° PASSO - CRIAR UMA VARIAVEL PRA ERRO E OUTRA PRA GUARDAR OS FORNECEDORES, 
// A DE ERRO COM O VALOR NULL E A DE FORNECEDORES COM UM ARRAY VAZIO
    $erro = null;
    $fornecedores = [];

// SECTION 15 - 4° PASSO - FAZER A VERIFICAÇÃO DE ERRO 
    try {
    $fornecedores =  buscarFornecedores($conexao);
    } catch (Throwable $e) {
     $erro = "Erro ao buscar fornecedores. <br>" .$e->getMessage();
    }

    
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-people-fill"></i> Fornecedores</h3>

<!-- // SECTION 15 - 5° PASSO - COLOCAR O ERRO VISIVELMENTE NO HTML -->
     <?php if($erro): ?>
     <p class="alert alert-danger text-center">
          <?= $erro ?>
     </p>
     <?php endif; ?>

     <p>
          <a class="btn btn-primary" href="inserir.php">
              <i class="bi bi-plus-circle"></i> Adicionar Novo fornecedor
          </a>
     </p>

     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
                <!--  // SECTION 15 - 7° PASSO - Não esquecer da contagem -->
               <caption>Quantidade de resgistros: <?= count($fornecedores) ?></caption>
               <thead class="align-middle table-light">
                    <tr>
                         <th>ID</th>
                         <th>Nome</th>
                         <th colspan="2">Ações</th>
                    </tr>
               </thead>

               <tbody>
                    <!-- // SECTION 15 - 6° PASSO - FAZER COM QUE O ID E NOME DO FORNECEDORES APAREÇAM NO HTML, COM O FOREACH -->
                     <?php foreach($fornecedores as $fornecedor): ?>
                    <tr>
                         <td><?= $fornecedor['id'] ?></td>
                         <td><?= $fornecedor['nome'] ?></td>
                         <!--  // SECTION 15 - 8° PASSO - Ja programar os links dinamicos ("?id=fornecedor[id]" no href) -->
                         <td><a class="btn btn-warning btn-sm" href="editar.php?id=<?= $fornecedor['id'] ?>"><i class="bi bi-pencil-square"></i> Editar</a></td>
                         <td><a class="btn btn-danger btn-sm" href="excluir.php?id=<?= $fornecedor['id'] ?>"><i class="bi bi-trash"></i> Excluir</a></td>
                    </tr>
                    <?php endforeach; ?>
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>