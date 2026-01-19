<?php
require_once __DIR__ . '/../config.php';



?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme='auto'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title><?= $titulo ?? '' ?> Fly By Night - Gerenciamento de Estoque</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>/images/coruja.png" type="image/png" sizes='128x128'>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap-icons.min.css">
</head>

<body>
    <!--SECTION 13 - PASSO 3 - Acrescentendando elementos na barra de gerenciamento alem de estilizar o container   -->
    <div class="bg-primary text-white py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <!-- SECTION 13 - PASSO 5 - fazer um codigo para mostrar os elementos apenas se o usuario estiver logado  -->
                <?php if (usuarioEstaLogado()): ?>
                    <a href="<?= BASE_URL ?>/usuarios/listar.php" class="btn btn-sm btn-outline-light">
                        <i class="bi bi-people"> Gerenciar Usuarios</i>
                    </a>
                <?php endif; ?>
            </div>

            <!-- SECTION 13 - PASSO 6 - Condicionando para que se o usuario estiver logado mostra esse bloco de programação  -->
            <div class="d-flex align-items-center">
                <?php if (usuarioEstaLogado()): ?>
                    <i class="bi bi-person-circle me-2"></i>
                    <!-- // SECTION 14 - 11° PASSO - FAZER COM QUE APARECE O NOME DO INDIVIDUO LOGADO -->
                    <span class="me-3">Ola, <?= $_SESSION['nome'] ?></span>
                    <a href="<?= BASE_URL ?>/logout.php" class="btn btn-sm btn-outline-light"> <i class="bi bi-box-arrow-right me-1"></i>Sair</a>
                    <!-- CASO O USUARIO NAO ESTEJA LOGADO -->
                <?php else: ?>
                    <i class="bi bi-person-x me-2"></i>
                    <span class="me-3">Você não esta logado!!</span>
                <?php endif; ?>
            </div>
        </div>

    </div>

<!-- SECTION 13 - PASSO 7 - Condicionando para que se o usuario estiver logado mostra esse bloco de programação  -->
    <?php if(usuarioEstaLogado()): ?>
    <header class="border-bottom border-primary-subtle bg-body">
        <div class="container">
            <div class="row align-items-center py-2 justify-content-between">
                <div class="col-4">
                    <h1 class="fs-4"><a class="text-decoration-none" href="<?= BASE_URL ?>/index.php">Fly By Night</a></h1>
                    <h2 class="fs-6 lead">Gerenciamento de Estoque</h2>
                </div>
                <div class="col-8">
                    <nav>
                        <ul class="nav justify-content-end">
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php"><i class="bi bi-house-fill"></i> Início</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/fornecedores/listar.php"><i class="bi bi-people-fill"></i> Fornecedores</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produtos/listar.php"><i class="bi bi-box-fill"></i> Produtos</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/lojas/listar.php"><i class="bi bi-tags-fill"></i> Lojas</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/estoque/listar.php"><i class="bi bi-stack"></i> Estoque</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>

    <main class="container my-4">