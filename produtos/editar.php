 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Editar Produto |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Produto</h3>
     
     <!-- Tabela de criação do produto -->
     <form action="" method="POST" class="w-75 mx-auto">
          <fieldset>
               <legend>Produto</legend>
               <div class="form-group mb-3">
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" name="nome" id="nome" class="form-control"  value="Nome..">
          </div>

          <div class="form-group mb-3">
               <label for="descricao" class="form-label">Descrição:</label>
               <textarea class="form-control" id="descricao" name="descricao">Descrição...</textarea>
          </div>

          <div class="form-group mb-3">
               <label for="preco" class="form-label">Preço:</label>
               <input  value="10" type="number" name="preco" id="preco" class="form-control" min="0" step="0.01">
          </div>

           <div class="form-group mb-3">
               <label for="quantidade" class="form-label">Quantidade:</label>
               <input  value="10" type="number" name="quantidade" id="quantidade" class="form-control" min="0">
          </div>

          <div class="form-group mb-3">
               <label for="fornecedor_id" class="form-label">Fornecedor:</label>
               <select name="fornecedor_id" id="fornecedor_id" class="form-select">
                    <option value=""></option>
                    <option value="id do fornecedor" selected>Nome do Fornecedor</option>
               </select>
          </div>
          </fieldset>

          <!-- Tabela de deatalhes do produto -->
           <fieldset class="mt-4">
               <legend>Detalhes do Produto</legend>
               <div class="form-group mb-3">
                    <label for="peso" class="form-label">Peso (kg):</label>
                    <input  value="10" type="number" name="peso" id="peso" class="form-control" step="0.01">
               </div>

               <div class="form-group mb-3">
                    <label for="dimensoes" class="form-label">Dimensões (LxAxP):</label>
                    <input  value="10x20x5" type="text" name="dimensoes" id="dimensoes" class="form-control" >
               </div>

               <div class="form-group mb-3">
                    <label for="codigo_barras" class="form-label">Código de barras: </label>
                    <input  value="078549846" type="text" name="codigo_barras" id="codigo_barras" class="form-control">
               </div>

                <div class="form-group mb-3">
                    <label for="data_validade" class="form-label">Data de validade:  </label>
                    <input value="2025-05-20" type="date" name="data_validade" id="data_validade" class="form-control">
               </div>

           </fieldset>
          
          <button class="btn btn-warning my-4" type="submit">
               <i class="bi bi-arrow-clockwise "></i> Salvar Alterações
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>