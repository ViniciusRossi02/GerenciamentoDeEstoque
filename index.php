 <?php

    require_once __DIR__ ."/config.php";

    require_once BASE_PATH ."/includes/cabecalho.php";
?>

        <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
            <h3><i class="bi bi-journal-check fs-4"></i> Resumo</h3>
            <div class="row">
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Produtos cadastrados</b></p>
                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Fornecedores</b></p>
                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Lojas Ativas</b></p>
                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Lojas sem estoques</b></p>
                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Estoque < 5</b></p>
                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Produtos vencidos ou vencendo em ate trinta dias</b></p>
                </div>
            </div>
        </section>
        <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
            <h3><i class="bi bi-file-earmark-text fs-4"></i> Relatórios</h3>
            <a href="<?=BASE_URL?>/relatorios/produtos-por-loja.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-box-seam"></i> Produtos por loja</a>
            <a href="<?=BASE_URL?>/relatorios/produtos-por-fornecedor.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-people"></i>Produtos por Fornecedor</a>
            <a href="<?=BASE_URL?>/relatorios/estoque-por-produto.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-clipboard-data"></i> Estoque por Produto </a>
            <a href="<?=BASE_URL?>/relatorios/estoque-baixo.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-exclamation-triangle"></i> Estoque Baixo</a>
        </section>
   
        <?php require_once BASE_PATH ."/includes/rodape.php" ?>;