 <?php

     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . '/src/utils.php';
     require_once BASE_PATH . "/src/usuario_crud.php";

     exigirLogin();

     $id = sanitizar($_GET['id'], 'inteiro');
     $erro = null;

     if(!$id){
          header('location: listar.php');
          exit;
     }
     
     try {
          $usuario = buscarUsuarioPorId($conexao, $id);
          if (!$usuario) $erro = "Usuario não encontrado";
          
     } catch (Throwable $e) {
          $erro = "Erro ao buscar usuário <br>" . $e->getMessage();
     }

     //  CAPTURAR E SANITIZAR OS DADOS DO FORMULARIO
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $nome = sanitizar($_POST['nome']);
          $email = sanitizar($_POST['email'], 'email');
          $senhaForm = $_POST['senha']; 

     // VALIDAÇÃO SE OS CAMPOS FORAM PREENCHIDOS
     if(empty($nome) || empty($email)){
          $erro = "Nome e e-mail são obrigatórios";
     }else {
          try {
          // Definição da senha (vazio? manter a existente; digitou: é igual? manter; é diferente? codificar a nova senha)
          // se senha vazia, mantem a anterios que esta salva no banco de dados; Função no utils
          $senhaVerificada = empty($senhaForm) ? 
          $usuario['senha'] : 
          verificarSenha($senhaForm,$usuario['senha']);
     
          // executar o update no banco
          atualizarUsuario($conexao, $id, $nome, $email, $senhaVerificada);

          // reedirecionar para a página de listar
          header("location: listar.php");
          exit;

          } catch (Throwable $e) {
               if($e->getCode() === "23000"){
                    $erro = "E-mail já cadastrado. Por Favor, use outro e-mail.";
               }else {   
                    $erro = "Erro ao atualizar o usuario: <br>" .$e->getMessage();
               }
          }
          
     }
     }

     $titulo = "Editar Usuário |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Usuário</h3>

      <?php if ($erro): ?>
           <p class="alert alert-danger text-center"><?= $erro ?></p>
      <?php endif; ?>

      <form action="" method="POST" class="w-75 mx-auto">
           <input type="hidden" name="id" value="<?= $usuario['id'] ?? ''?>">
           <div class="form-group"> 
                <label required for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $usuario['nome'] ?? ''?>">
           </div>

           <div class="form-group">
                <label required for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $usuario['email'] ?? ''?>">
           </div>

           <div class="form-group">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="preencha apenas se for alterar a senha">
           </div>

           <button class="btn btn-warning my-4" type="submit">
                <i class="bi bi-arrow-clockwise "></i> Salvar Alterações
           </button>
      </form>


 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>