 <?php

    require_once __DIR__ ."/../config.php";
    require_once BASE_PATH ."/src/utils.php";
    require_once BASE_PATH ."/src/estoque_crud.php";
     
    exigirLogin();

    $loja_id = sanitizar($_GET['loja_id'], 'inteiro');
    $produto_id = sanitizar($_GET['produto_id'], 'inteiro');
    $erro = null;

    if(!$loja_id || !$produto_id){
     header("Location:listar.php");
     exit;          
    }

    try {
     $estoque = buscarEstoquePorIds($conexao, $loja_id, $produto_id);
     if(!$estoque) $erro = "Estoque não encontrado.";
    } catch (Throwable $e) {
     $erro = "Erro ao buscar estoque: " . $e->getMessage();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
     $estoque = sanitizar($_POST['estoque'], 'inteiro');

     try {
          atualizarEstoque($conexao, $loja_id, $produto_id, $estoque);
          header("location: listar.php");
          exit;
     } catch (PDOException $e) {
          $codigoErro = $e->errorInfo[1] ?? null;
          if($codigoErro === 3819){
               $erro = "O estoque não pode ser negativo.";
          }else {
               $erro = "Erro ao inserir os dados. <br>" . $e->getMessage();
          }
     } catch(Throwable $e) {
          $erro = "Erro inesperado. <br>" . $e->getMessage();
     }

    }

    $titulo = "Editar Estoque |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Estoque</h3>

     <?php if($erro): ?>
          <p class="alert alert-danger text-center">
               <?= $erro ?>
          </p>
     <?php endif; ?>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <input type="hidden" name="loja_id" value="<?= $estoque['loja_id'] ?? '' ?>">
          <input type="hidden" name="produto_id" value="<?= $estoque['produto_id'] ?? '' ?>">

          <div class="form-group mb-3">
               <label for="loja" class="form-label">Loja:</label>
               <input disabled readonly type="text" class="form-control" name=loja id="loja" value="<?= $estoque['nome_loja'] ?? '' ?>">
          </div>

          <div class="form-group mb-3">
               <label for="produto" class="form-label">produto:</label>
               <input disabled readonly type="text" class="form-control" name="produto" id="produto" value="<?= $estoque['nome_produto'] ?? '' ?>">
          </div>

          <div class="form-group mb-3">
               <label for="estoque" class="form-label">Quantidade em estoque:</label>
               <input type="number" name="estoque" id="estoque" class="form-control" value="<?= $estoque['estoque'] ?? 0 ?>" min="0">
          </div>
          <button class="btn btn-warning my-4" type="submit">
               <i class="bi bi-arrow-clockwise "></i> Salvar Alterações
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>