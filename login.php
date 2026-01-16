 <?php

    require_once __DIR__ ."/config.php";

    // <!-- SECTION 13 - PASSO 3 - Array de mensagem e estilo/classe para formatação

    $mensagens = [
        'acesso_proibido' => ['Acesso proibido! Você precisa estar logado para acessar esta página.', 'danger']
    ];


    $titulo = "Login |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

        <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
            <h1 class="mb-2">Fly By Night</h1>
            <h2 class="fs-6 lead">Gerenciamento de Estoque</h2>

            <hr>

            <h3>Login</h3>

            <!-- SECTION 13 - PASSO 4 Usamos FOREACH para acessar cada elemento do array mensagens 
            e extrair a mensagem e a classe.
            -->

            <?php foreach($mensagens as $elemento => [$mensagem, $tipo]):
                if(isset($_GET[$elemento])):?>
            <div  class="alert alert-<?= $tipo ?> text-center"> 
                <?=$mensagem?>
            </div>
            <?php
            endif;
            endforeach; ?>

            <p class="lead"> Entre com seu e-mail e senha para acessar o sistema</p>

            <form action="" method="post" class="w-50 mx-auto text-start mt-30">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                 <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control">
                </div>
            </form>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </section>
       
        <?php require_once BASE_PATH ."/includes/rodape.php" ?>;