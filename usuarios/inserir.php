 <?php

     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . "/src/utils.php";
     require_once BASE_PATH . "/src/usuario_crud.php";

     $erro = null;

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $nome = sanitizar($_POST['nome'], 'texto');
          $email = sanitizar($_POST['email'], 'email');
          $senhaForm = $_POST['senha'];

          if (empty($nome) || empty($email) || empty($senhaForm)) {
               $erro = "Preencha todos os campos!!";
          } else {
               try {
                    // CODIFICAR A SENHA
                    $senhaCodificada = codificarSenha($senhaForm);

                    // ENVIAR OS DADOS PARA O BANCO
                    inserirUsuario($conexao, $nome, $email, $senhaCodificada);

                    // REDIRECIONAR PARA A LISTA DE USUARIO
                    header("location: listar.php");
                    exit;
               } catch (Throwable $e) {
                    if($e->getCode() === '23000'){
                         $erro = "e-mail já cadastrado. Por favor, use outro e-mail";
                    }else{
                         $erro = "Erro ao inserir usuario. <br>" .$e->getMessage();
                    }
               }
          }
     }


     $titulo = "Adicionar Usuário |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Usuário</h3>

      <?php if ($erro): ?>
           <p class="alert alert-danger text-center"><?= $erro ?></p>
      <?php endif; ?>

      <form action="" method="POST" class="w-75 mx-auto">
           <div class="form-group">
                <label for="nome" class="form-label">Nome:</label>
                <input required value="<?=$_POST['nome'] ?? '' ?>" type="text" name="nome" id="nome" class="form-control">
           </div>

           <div class="form-group">
                <label for="email" class="form-label">E-mail:</label>
                <input required value="<?=$_POST['email'] ?? '' ?>" type="email" name="email" id="email" class="form-control">
           </div>

           <div class="form-group">
                <label for="senha" class="form-label">Senha:</label>
                <input required type="password" name="senha" id="senha" class="form-control">
           </div>

           <button class="btn btn-success my-4" type="submit">
                <i class="bi bi-check-circle "></i> Salvar
           </button>
      </form>


 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>