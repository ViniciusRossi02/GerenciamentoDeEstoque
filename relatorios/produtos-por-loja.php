 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Produtos por Loja |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-box-seam"></i> Produtos Por Loja</h3>
     
     <form action="" method="get" class="mx-auto my-4">
          <div class="row g-2 justify-content-center">
               <div class="col-auto">
                    <label for="loja_id" class="text-muted col-form-label">Selecione a Loja</label>
               </div>
               <div class="col-auto">
                    <select name="loja_id" id="loja_id" class="form-select">
                         <option value=""></option>
                         <option value="id da loja...">
                              nome da loja...
                         </option>
                    </select>
               </div>
          </div>
     </form>

     <p class="fw-semibold">Produtos disponíveis nesta loja:</p>

     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
               <caption>Quantidade de resgistros: 0</caption>
               <thead class="align-middle table-light">
                    <tr>
                         <th>Produto</th>
                         <th>Preço</th>
                         <th>Fornecedor</th>
                         <th>Estoque</th>    
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td>Nome do produto..</td>
                         <td>Preço do produto..</td>
                         <td>Fornecedor do produto..</td>
                         <td>Estoque do produto da loja...</td>
                         
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>