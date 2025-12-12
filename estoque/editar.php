 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Editar Estoque |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Estoque</h3>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <input type="hidden" name="loja_id" value="ID da loja">
          <input type="hidden" name="produto_id" value="ID da produto">

          <div class="form-group">
               <label for="estoque" class="form-label">Quantidade em estoque:</label>
               <input type="number" name="estoque" id="estoque" class="form-control" value="0">
          </div>
          <button class="btn btn-warning my-4" type="submit">
               <i class="bi bi-arrow-clockwise "></i> Salvar Alterações
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>