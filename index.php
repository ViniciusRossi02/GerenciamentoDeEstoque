 <?php

    // SECTION 26 - 2° PASSO - incluir diretorios para pastas que vamos utilizar 

    require_once __DIR__ . "/config.php";
    require_once BASE_PATH . "/src/resumo_crud.php";
    require_once BASE_PATH . "/src/utils.php";

    exigirLogin();

    // SECTION 26 - 3° PASSO - Criar varaivel para cada função que contem os dados 
    $totalProdutos = contarProdutos($conexao);
    $totalFornecedores = contarFornecedores($conexao);
    $totalLojas = contarLojas($conexao);
    $totalLojasSemRegistrosDeEstoque = contarLojasSemRegistroDeEstoque($conexao);
    $totalEstoquesBaixo = contarEstoquesBaixo($conexao);
    $totalProdutosVencidosOuVencendo = contarProdutosVencidosOuVencendo($conexao);



    require_once BASE_PATH . "/includes/cabecalho.php";
    ?>
<!-- // SECTION 26 - 6° PASSO - INSEIRNDO UM ALERTA PARA CASO TENHA ALGUM PORDUTO VENCIDO OU VENCENDO  -->
<?php if($totalProdutosVencidosOuVencendo > 0): ?>
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <i class="bi bi-exclamation-circle"></i> <strong>Atenção!</strong> <?= $totalProdutosVencidosOuVencendo ?> produto(os) vencido(s) ou perto de vencer!!
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
<?php endif;?>

<!-- // SECTION 26 - 4° PASSO - incluir os dados em cada campo correto, e se quiser
 fazer validações para alterar estilos  -->
 <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-journal-check fs-4"></i> Resumo</h3>
     <div class="row">
         <div class="col-6 col-md-4">
             <h4><span class="badge text-bg-primary"><?= $totalProdutos ?></span></h4>
             <p><b>Produtos cadastrados</b></p>
         </div>
         <div class="col-6 col-md-4">
             <h4><span class="badge text-bg-primary"><?= $totalFornecedores ?></span></h4>
             <p><b>Fornecedores</b></p>
         </div>
         <div class="col-6 col-md-4">
             <h4><span class="badge text-bg-primary"><?= $totalLojas ?></span></h4>
             <p><b>Lojas Ativas</b></p>
         </div>
         <div class="col-6 col-md-4">
             <?php $classeLojas = $totalLojasSemRegistrosDeEstoque > 0 ? "danger" : "success" ?>
             <h4><span class="badge text-bg-<?= $classeLojas ?>"><?= $totalLojasSemRegistrosDeEstoque ?></span></h4>
             <p><b>Lojas sem registro de estoques</b></p>
         </div>
         <div class="col-6 col-md-4">
             <?php $classeEstoque = $totalEstoquesBaixo > 0 ? "warning" : "success" ?>
             <h4><span class="badge text-bg-<?= $classeEstoque ?>"><?= $totalEstoquesBaixo ?></span></h4>
             <p><b>Estoque < 5</b>
             </p>
         </div>
         <div class="col-6 col-md-4">
             <?php $classeVencido = $totalProdutosVencidosOuVencendo > 0 ? "danger" : "success" ?>
             <h4><span class="badge text-bg-<?= $classeVencido ?>"><?= $totalProdutosVencidosOuVencendo ?></span></h4>
             <p><b>Produtos vencidos ou vencendo em ate trinta dias</b></p>
         </div>

         <!-- // SECTION 26 - 5° PASSO - Acescentando uma data e hora de visualização -->
        <p class="text-muted small text-end mt-3">
            📅 Consulta feita em: <time datetime="<?= date("c") ?>"><?= ultimaAtualização() ?></time> 
        </p>

     </div>
 </section>
 <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-file-earmark-text fs-4"></i> Relatórios</h3>
     <a href="<?= BASE_URL ?>/relatorios/produtos-por-loja.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-box-seam"></i> Produtos por loja</a>
     <a href="<?= BASE_URL ?>/relatorios/produtos-por-fornecedor.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-people"></i>Produtos por Fornecedor</a>
     <a href="<?= BASE_URL ?>/relatorios/estoque-por-produto.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-clipboard-data"></i> Estoque por Produto </a>
     <a href="<?= BASE_URL ?>/relatorios/estoque-baixo.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-exclamation-triangle"></i> Estoque Baixo</a>
 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php" ?>;