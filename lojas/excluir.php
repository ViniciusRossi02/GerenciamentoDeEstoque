 <?php

    require_once __DIR__ ."/../config.php";
    require_once BASE_PATH . '/src/loja_crud.php';
    require_once BASE_PATH . '/src/utils.php';
     

    exigirLogin();

    $id = sanitizar($_GET['id'], 'inteiro');
    $erro = null;

    // IMPEDIR COM QUE O USUARIO LOGADO SE EXCLUA!!!
    if($id === $_SESSION['id'])
     {
          $erro = "Você não pode excluir a loja que está logada no momento.";
     }

     if(!$id)
          {
               header("Location: listar.php");
               exit;
          }

     try {
          $loja = buscarLojaPorId($conexao, $id);
          if(!$loja) $erro = "Loja não encontrada.";
     } catch (Throwable $e) {
          $erro = "Erro ao excluir a loja. Detalhes: ".$e->getMessage();
     }

 if(isset($_GET['confirmar-exclusao']))
     {
          try {
           excluirLoja($conexao, $id);
          header("Location: listar.php");
          exit;
     }catch (Throwable $e) {
               if($e->getCode() === '23000') {
                    $erro = "Não é possível excluir esta loja, pois existem produtos vinculados a ela.";
               } else {
                    $erro = "Erro ao excluir a loja. Detalhes: ".$e->getMessage();
               }
          }
     }

    $titulo = "Excluir Loja |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Loja</h3>

      <?php if($erro): ?>
          <p class="alert alert-danger text-center">
               <?= $erro ?>
          </p>
     <?php else: ?>
     
     <div class="alert alert-danger w-50 text-center mx-auto">
          <p>Deseja realmente exlucir a loja <b><?= $loja['nome'] ?> </b>?</p>
          <p>Caso existam registros de estoque dela, <b>eles tambem serão excluidos</b></p>
          <a class="btn btn-secondary" href="listar.php"><i class="bi bi-x-circle"></i>  Não</a>
          <a class="btn btn-danger" href="?id=<?= $loja['id']?>&confirmar-exclusao"><i class="bi bi-check-circle"></i> Sim</a>
     </div>
     <?php endif; ?>

</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>