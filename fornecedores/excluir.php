 <?php

     require_once __DIR__ . "/../config.php";
     // SECTION 16 - 8° passo - Chamar as paginas
     require_once BASE_PATH . "/src/fornecedor_crud.php";
     require_once BASE_PATH . "/src/utils.php";


     exigirLogin();

     // SECTION 16 - 9° passo - CRIAR variavel para pegar o ID e o erro
     $id = sanitizar($_GET['id'], 'inteiro');
     $erro = null;

      // SECTION 16 - 12° PASSO - IMPEDIR COM QUE O USUARIO LOGADO SE EXCLUA!!!
     if ($id === $_SESSION['id']) {
          $erro = $_SESSION['nome'] . ", você não pode excuir a si mesmo";
     }

     // SECTION 16 - 10° passo - Verificar se possue ID 
     if (!$id) {
          header('location: listar.php');
          exit;
     }
     // SECTION 16 - 13° passo - tratativa de erros caso de algo de errado com o banco, caso nao de (TRY)
     try {
          $fornecedor = buscarFornecedorPorId($conexao, $id);
          if (!$fornecedor) $erro = "fornecedor não encontrado!!!";
     } catch (Throwable $e) {
          $erro = "Erro ao buscar fornecedor. <br>" . $e->getMessage();
     }

     // SECTION 16 - 14° passo - Codnicional para verificar se ouve o confirmar-exclusao
     if(isset($_GET['confirmar-exclusao'])){
          try {
               excluirFornecedor($conexao, $id);
               header('location: listar.php');
               exit;
          } catch (Throwable $e) {
               // SECTION 16 - 15° passo - Criar um mensagem de erro amigavel caso o fornecedor estiver com produtos cadastrados e nao puder ser excluido
               if($e->getCode() === '23000'){
                    $erro = "<b>".$fornecedor['nome']."<b> está vinculado a outros registros no banco de dados, e não pode ser excluido.";
               }else{
                    $erro = "Erro ao excluir fornecedor. <br>".$e->getMessage();
               }
               
          }
     }

     $titulo = "Excluir Fornecedor |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Fornecedor</h3>

       <!-- // SECTION 16 - 10° passo - tratativa de erros aparecendo no HTML -->
      <?php if ($erro): ?>
           <p class="alert alert-danger text-center"><?= $erro ?></p>

     <!--  // SECTION 16 - 11° passo - Condicionar para que bloco so apareça caso de mesmo para excliuir-->

      <?php else: ?>
          
      <div class="alert alert-danger w-50 text-center mx-auto">
           <p>Deseja realmente exlucir o fornecedor <b><?= $fornecedor['nome'] ?></b>?</p>
           <a class="btn btn-secondary" href="listar.php"><i class="bi bi-x-circle"></i> Não</a>
           <a class="btn btn-danger" href="?id=<?= $fornecedor['id'] ?>&confirmar-exclusao"><i class="bi bi-check-circle"></i> Sim</a>
      </div>
          <?php endif; ?>

 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>