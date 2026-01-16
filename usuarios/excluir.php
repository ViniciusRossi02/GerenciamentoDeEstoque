 <?php

     require_once __DIR__ . "/../config.php";
     //     SEC 12 - 2º PASSO - INCLUIR O ARQUIVO DE CRUD E UTILS
     require_once BASE_PATH . "/src/usuario_crud.php";
     require_once BASE_PATH . "/src/utils.php";

     exigirLogin();

     //     SEC 12 - 3º PASSO - Pegar da URL o ID do usuario a ser excluido com o metodo GET e deixand seguro com a funcao sanitizar
     $id = sanitizar($_GET["id"], 'inteiro');
     $erro = null;

     //     SEC 12 - 4º PASSO - Impedir que algeum tente acessar a pagina excluir direto da URL sem informar o ID
     if (!$id) {
          header("Location: listar.php");
          exit;
     }

     //     SEC 12 - 5º PASSO - açoes necessarias pra carregar os dados do usuario a ser excluido
     try {
          $usuario = buscarUsuarioPorId($conexao, $id);
          // caso nao tenha o usuario
          if (!$usuario) $erro = "Usuario nao encontrado";
     } catch (Throwable $e) {
          $erro = "Erro ao buscar usuario: <br>" . $e->getMessage();
     }

     //     SEC 12 - 8º PASSO - Verificar se existe um parametro na URl chamado confirmar-exclusao e se nao tem erros

     if(isset($_GET['confirmar-exclusao']) && !$erro){
          try {
               // chamar a funcao de excluir usuario do arquivo de CRUD (cria-lo antes)
               excluirUsuario($conexao, $id);
               header("location: listar.php");
               exit;
          } catch (Throwable $e) {
               $erro = "Erro ao excluir o usuario: <br>" . $e->getMessage();
          }
     }


     $titulo = "Excluir Usuário |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Usuário</h3>
     
      <!-- SEC 12 - 7º PASSO exibir o erro  -->
      <?php if ($erro): ?>
           <p class="alert alert-danger text-center"><?= $erro ?></p>
      <?php else: ?>

      <div class="alert alert-danger w-50 text-center mx-auto">
           <!-- SEC 12 - 6º PASSO Fazer aparecer o nome do usuario a ser exlcuido no HTML-->
           <p>Deseja realmente exlucir o Usuário <b><?= $usuario['nome'] ?? '' ?></b> ?</p>

           <!-- SEC 12 - 8º PASSO Programar LINK dinamico para excluir o usuário ao clicar no link-->
           <a class="btn btn-secondary" href="listar.php"><i class="bi bi-x-circle"></i> Não</a>

           <a class="btn btn-danger" href="?id=<?= $usuario['id']?>&confirmar-exclusao"> Sim</a>
      </div>

      <?php endif; ?>


 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>