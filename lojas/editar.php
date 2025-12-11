 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Editar Loja |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Loja</h3>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <input type="hidden" name="id" value="ID da loja...">
          <div class="form-group">
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" name="nome" id="nome" class="form-control" value="Nome da loja...">
          </div>
          <button class="btn btn-warning my-4" type="submit">
               <i class="bi bi-arrow-clockwise "></i> Salvar Alterações
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>