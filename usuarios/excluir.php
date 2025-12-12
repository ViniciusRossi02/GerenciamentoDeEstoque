 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Excluir Usuário |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Usuário</h3>
     
     <div class="alert alert-danger w-50 text-center mx-auto">
          <p>Deseja realmente exlucir o Usuário <b>Nome do usuario...</b> ?</p>
          <a class="btn btn-secondary" href="listar.php"><i class="bi bi-x-circle"></i>  Não</a>
          <a class="btn btn-danger" href=""><i class="bi bi-check-circle"></i> Sim</a>
     </div>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>