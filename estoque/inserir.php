 <?php
      // SECTION 24 - 7° PASSO - LINKS -->  
    require_once __DIR__ ."/../config.php";
    require_once BASE_PATH . "/src/estoque_crud.php";
    require_once BASE_PATH . "/src/loja_crud.php";
    require_once BASE_PATH . "/src/produto_crud.php";
    require_once BASE_PATH . "/src/utils.php";
     
    exigirLogin();
      // SECTION 24 - 8° PASSO - ERROS -->  
     $erro = null;
     $lojas = [];
     $produtos = [];

 // SECTION 24 - 9° PASSO -Conectar banco e msg de erro -->  
 try {
     $lojas = buscarLojas($conexao);
     $produtos = buscarProdutos($conexao);

     // SECTION 24 - 10° PASSO - EXTRAIMOS A COLUNA "NOME" DO ARRAY $PRODUTOS PARA UM ARRAY SEPARADO -->  
     $nomesDosProdutos = array_column($produtos, 'nome');
     // SECTION 24 - 11° PASSO - USAMOS ARRAY_MULTISORT PARA ORDENAR CRESCENTE (A - Z) $produtos COM BASE EM $nomesDosProdutos -->  
     array_multisort($nomesDosProdutos, SORT_ASC, $produtos);

 } catch (Throwable $e) {
     $erro = 'Erro ao buscar dados. <br>'. $e->getMessage();
 }

 // SECTION 24 - 12° PASSO - CAPTURAR E SANITIZAR DADOS ENVIADOS DO FOMULARIO -->  
 if($_SERVER['REQUEST_METHOD'] === 'POST')
     {
          $loja_id = sanitizar($_POST['loja_id'], 'inteiro');
          $produto_id = sanitizar($_POST['produto_id'], 'inteiro');
          $estoque = sanitizar($_POST['estoque'], 'inteiro');

          // SECTION 24 - 13° PASSO - VALIDAR DADOS -->
          if($loja_id && $produto_id)
               {
                    try {
                         inserirEstoque($conexao, $loja_id, $produto_id, $estoque);
                         header("Location: listar.php");
                         exit;
                    }catch (PDOException $e) {
                         $codigoErro = $e->errorInfo[1] ?? null;

                         if($codigoErro === 1062) {
                              $erro = "Este produto já está cadastrado nesta loja.";
                         }else if($codigoErro === 4025) {
                              $erro = "O estoque não pode ser negativo";
                         }else {
                              $erro = "Erro ao inserir os dados. <br>" . $e->getMessage();
                         }


                    } catch (Throwable $e) {
                         // USAMOS NESSE PONTO O THROWABLE PARA CAPTURAR/LIDAR ERROS INESPERADOS, COMO ERRO DE SINTAXE, ERRO DE INCLUDE, VARIAVEL INDEFINIDA....ETC
                         $erro = "Erro inesperado. <br>" . $e->getMessage();
                    }
               }else {
                    $erro = "Por Favor, preencha todos os campos obrigatórios.";
               }

     }




    $titulo = "Adicionar Produto á Loja |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto á Loja</h3>

      <?php if($erro): ?>
          <p class="alert alert-danger text-center">
               <?= $erro ?>
          </p>
     <?php endif; ?>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <div class="form-group mb-3">
               <label for="loja_id" class="form-label">Loja:</label>
               <select class="form-select"name="loja_id" id="loja_id">
                    <option value=""></option>
                    <?php foreach($lojas as $loja): ?>
                    <option value="<?= $loja['id'] ?>"><?=  $loja['nome'] ?></option>
                    <?php endforeach; ?>
               </select>
          </div>

          <div class="form-group mb-3">
               <label for="produto_id" class="form-label">Produto:</label>
               <select required name="produto_id" id="produto_id" class="form-select">
                    <option value=""></option>
                    <?php foreach($produtos as $produto): ?>
                    <option value="<?= $produto['id'] ?>"><?=  $produto['nome'] ?> </option>
                    <?php endforeach; ?>
               </select>
          </div>

          <div class="form-group mb-3">
               <label for="estoque" class="form-label">Estoque:</label>
               <input required class="form-control" type="number" name="estoque" id="estoque" min="0" value="<?= $_POST['estoque'] ?? 0 ?>">
          </div>

          <button class="btn btn-success my-4" type="submit">
               <i class="bi bi-check-circle "></i> Salvar
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>