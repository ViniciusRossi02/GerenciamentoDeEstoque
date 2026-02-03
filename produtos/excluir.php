 <?php

     // SECTION 22 - EXCLUIR PRODUTOS

     // SECTION 22 - 1° PASSO - LINKAR AS PAGINAS NECESSARIAS
     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . '/src/produto_crud.php';
     require_once BASE_PATH . '/src/utils.php';

     // SECTION 22 - 2° PASSO - PEGAR O ID DO PRODUTO A SER EXCLUIDO
     $id = sanitizar($_GET['id'], 'inteiro');
     $erro = null;


     exigirLogin();
     // SECTION 22 - 3° PASSO - VALIDAR SE O ID É VÁLIDO
     if(!$id){
          header("Location: listar.php");
          exit;
     }
     // SECTION 22 - 4° PASSO - BUSCAR O PRODUTO PELO ID PARA EXIBIR O NOME NA TELA DE CONFIRMAÇÃO
     try {
          $produto = buscarProdutoPorId($conexao, $id);
          if(!$produto) {
               $erro = "Produto não encontrado";
          } 
     } catch (Throwable $e) {
          $erro= "Erro ao buscar produto. <br>".$e->getMessage();
     }
     // SECTION 22 - 5° PASSO - EXCLUIR O PRODUTO APÓS A CONFIRMAÇÃO
     if(isset($_GET['confirmar-exclusao'])){
          try { 
               excluirProduto($conexao, $id);
               header("Location: listar.php");
               exit;
          } catch (Throwable $e) {
               if($e->getCode() === '23000'){
                    $erro= "Não é possivel excluir esse produto <br>".$produto['nome'].',</b> pois existem registros relacionados a ele.';
               }else {
                    $erro = "Erro ao excluir produto. <br>".$e->getMessage();
               }
          }
     }

     $titulo = "Excluir Produto |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Produto</h3>

     <?php if($erro): ?>
          <p class="alert alert-danger text-center">
               <?= $erro ?>
          </p>

     <?php else: ?>
      <div class="alert alert-danger w-50 text-center mx-auto">
           <p>Deseja realmente exlucir o produto <b><?= $produto['nome'] ?></b>?</p>
           <a class="btn btn-secondary" href="listar.php"><i class="bi bi-x-circle"></i> Não</a>
           <a class="btn btn-danger" href="?id=<?= $produto['produto_id']?>&confirmar-exclusao"><i class="bi bi-check-circle"></i> Sim</a>
      </div>
     <?php endif; ?>

 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>