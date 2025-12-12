 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Adicionar Produto á Loja |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto á Loja</h3>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <div class="form-group mb-3">
               <label for="loja_id" class="form-label">Loja:</label>
               <select class="form-select"name="loja_id" id="loja_id">
                    <option value=""></option>
                    <option value="id da loja">Nome da loja</option>
               </select>
          </div>

          <div class="form-group mb-3">
               <label for="produto_id" class="form-label">Produto:</label>
               <select name="produto_id" id="produto_id" class="form-select">
                    <option value=""></option>
                    <option value="id do produto...">Nome do produto </option>
               </select>
          </div>

          <div class="form-group mb-3">
               <label for="estoque" class="form-label">Estoque:</label>
               <input class="form-control" type="number" name="estoque" id="estoque" min="0">
          </div>
          <button class="btn btn-success my-4" type="submit">
               <i class="bi bi-check-circle "></i> Salvar
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>