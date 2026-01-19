 <?php

    require_once __DIR__ . "/config.php";

    // SECTION 14 - 3° PASSO - Chamar pasta para utils e no passo 6 o pro Usuario_crud
    require_once BASE_PATH .'/src/usuario_crud.php';
    require_once BASE_PATH . "/src/utils.php";


    // SECTION 14 - 2° PASSO - realizar um if verificando se nosso formulario foi acionado em algum momento/ SANITIZAR OS DADOS
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = sanitizar($_POST['email'] ?? '', 'email');
        $senha = $_POST['senha'] ?? '';

        // SECTION 14 - 4° PASSO - verificar se a senha ou o email esta vazio
        if(empty($email) || empty($senha)) 
            {
                header('location:login.php?campos_obrigatorios');
                exit;
            }

        // SECTION 14 - 6° PASSO - Criar uma função pra buscar usuarios (Não esqeucer o require_once) // testar com a função  dump($usuario);
        $usuario = buscarPorEmail($conexao, $email);
        
        // SECTION 14 - 7° PASSO - checa se existe dados na variavel usuarios e se a senha bate com a existente no bdd
        if($usuario && password_verify($senha, $usuario['senha'])){
            login($usuario['id'], $usuario['nome']);
            header("location:index.php");
            exit;
        }else {
            header('location: login.php?login_invalido');
            exit();
        }
    }

    // <!-- SECTION 13 - PASSO 3 - Array de mensagem e estilo/classe para formatação

    $mensagens = [
        'acesso_proibido' => ['Acesso proibido! Você precisa estar logado para acessar esta página.', 'danger'],
        // SECTION 14 - 5° PASSO - mensagem caso o campo email ou senha estiverem vazios (Prox pagina usuario_crud)
        'campos_obrigatorios' => ['Campos obrigatorios não preenchidos', 'warning'],
        // SECTION 14 - 8° PASSO - mensagem caso o login ou senha for ivalidos (após fazer o passo 7) ;
        'login_invalido' => ['E-mail e/ou senha inválidos', 'danger'],
         // SECTION 14 - 9° PASSO - mensagem para logot (funcition no autenticacao.php)
        'logout' => ["Você saiu do sistema com sucesso!!!", "success"]

    ];


    $titulo = "Login |";
    require_once BASE_PATH . "/includes/cabecalho.php";
    ?>

 <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h1 class="mb-2">Fly By Night</h1>
     <h2 class="fs-6 lead">Gerenciamento de Estoque</h2>

     <hr>

     <h3>Login</h3>

     <!-- SECTION 13 - PASSO 4 Usamos FOREACH para acessar cada elemento do array mensagens 
            e extrair a mensagem e a classe.
            -->

     <?php foreach ($mensagens as $elemento => [$mensagem, $tipo]):
            if (isset($_GET[$elemento])): ?>
             <div class="alert alert-<?= $tipo ?> text-center">
                 <?= $mensagem ?>
             </div>
     <?php
            endif;
        endforeach; ?>

     <p class="lead"> Entre com seu e-mail e senha para acessar o sistema</p>


     <form action="" method="post" class="w-50 mx-auto text-start mt-3">
         <div class="mb-3">
             <label for="email" class="form-label">E-mail:</label>
             <input required ="email" name="email" id="email" class="form-control">
         </div>
        
         <div class="mb-3">
             <label for="senha" class="form-label">Senha:</label>
             <input required type="password" name="senha" id="senha" class="form-control">
         </div>
        <!-- // SECTION 14 - 13° PASSO  ADICIONAR O REQUIRED (VALIDAÇÃO FRONT-END)-->
         <div class="text-center">
             <button type="submit" class="btn btn-primary">Entrar</button>
         </div>
     </form>


 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php" ?>;