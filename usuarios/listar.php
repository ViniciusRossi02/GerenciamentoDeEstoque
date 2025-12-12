 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Usuários |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-person-gear"></i> Usuários</h3>
     <p>
          <a class="btn btn-primary" href="inserir.php">
              <i class="bi bi-plus-circle"></i> Adicionar Novo Usuários
          </a>
     </p>

     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
               <caption>Quantidade de resgistros: 0</caption>
               <thead class="align-middle table-light">
                    <tr>
                         <th>ID</th>
                         <th>Nome</th>
                         <th>E-mail</th>
                         <th colspan="2">Ações</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td>Id do usuario..</td>
                         <td>Nome do Usuario..</td>
                         <td>E-mail do Usuario..</td>
                         <td><a class="btn btn-warning btn-sm" href="editar.php"><i class="bi bi-pencil-square"></i> Editar</a></td>
                         <td><a class="btn btn-danger btn-sm" href="excluir.php"><i class="bi bi-trash"></i> Excluir</a></td>
                    </tr>
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>