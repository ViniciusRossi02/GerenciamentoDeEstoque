 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Adicionar Produto |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto</h3>
     
     <!-- Tabela de criação do produto -->
     <form action="" method="POST" class="w-75 mx-auto">
          <fieldset>
               <legend>Produto</legend>
               <div class="form-group mb-3">
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" name="nome" id="nome" class="form-control">
          </div>

          <div class="form-group mb-3">
               <label for="descricao" class="form-label">Descrição:</label>
               <textarea class="form-control" id="descricao" name="descricao"></textarea>
          </div>

          <div class="form-group mb-3">
               <label for="preco" class="form-label">Preço:</label>
               <input type="number" name="preco" id="preco" class="form-control" min="0" step="0.01">
          </div>

           <div class="form-group mb-3">
               <label for="quantidade" class="form-label">Quantidade:</label>
               <input type="number" name="quantidade" id="quantidade" class="form-control" min="0">
          </div>

          <div class="form-group mb-3">
               <label for="fornecedor_id" class="form-label">Fornecedor:</label>
               <select name="fornecedor_id" id="fornecedor_id" class="form-select">
                    <option value=""></option>
                    <option value="id do fornecedor">Nome do Fornecedor</option>
               </select>
          </div>
          </fieldset>

          <!-- Tabela de deatalhes do produto -->
           <fieldset class="mt-4">
               <legend>Detalhes do Produto</legend>
               <div class="form-group mb-3">
                    <label for="peso" class="form-label">Peso (kg):</label>
                    <input type="number" name="peso" id="peso" class="form-control" step="0.01">
               </div>

               <div class="form-group mb-3">
                    <label for="dimensoes" class="form-label">Dimensões (LxAxP):</label>
                    <input type="text" name="dimensoes" id="dimensoes" class="form-control">
               </div>

               <div class="form-group mb-3">
                    <label for="codigo_barras" class="form-label">Código de barras: </label>
                    <input type="text" name="codigo_barras" id="codigo_barras" class="form-control">
               </div>

                <div class="form-group mb-3">
                    <label for="data_validade" class="form-label">Data de validade:  </label>
                    <input type="date" name="data_validade" id="data_validade" class="form-control">
               </div>

           </fieldset>
          
          <button class="btn btn-success my-4" type="submit">
               <i class="bi bi-check-circle "></i> Salvar
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>