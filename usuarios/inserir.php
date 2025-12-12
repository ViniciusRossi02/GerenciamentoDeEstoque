 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Adicionar Usuário |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Usuário</h3>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <div class="form-group">
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" name="nome" id="nome" class="form-control">
          </div>

           <div class="form-group">
               <label for="email" class="form-label">E-mail:</label>
               <input type="email" name="email" id="email" class="form-control">
          </div>

          <div class="form-group">
               <label for="senha" class="form-label">Senha:</label>
               <input type="password" name="senha" id="senha" class="form-control">
          </div>

          <button class="btn btn-success my-4" type="submit">
               <i class="bi bi-check-circle "></i> Salvar
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>