 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Estoque Baixo |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-exclamation-triangle"></i>Estoque Baixo</h3>
     
     <form action="" method="get" class="mx-auto my-4">
          <div class="row g-2 justify-content-center">
               <div class="col-auto">
                    <label for="produto_id" class="text-muted col-form-label">Exibir produtos com estoque abaixo de: </label>
               </div>
               <div class="col-auto">
                    <input type="number" name="limite" id="limite" class="form-control" min="1" value="5">
               </div>
               <div class="col-auto">
                    <button class="btn btn-outline-primary" type="submit">Filtrar</button>
               </div>
          </div>
     </form>


     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
               <caption>Quantidade de resgistros: 0</caption>
               <thead class="align-middle table-light">
                    <tr>
                         <th>Produto</th>
                         <th>Loja</th>  
                         <th>Estoque</th>   
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td>Nome do produto..</td>
                         <td>Nome da loja..</td>
                         <td>quantidade do Estoque...</td>
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>