 <?php
     // <!--  SECTION 17 - 2° Linkar as paginas necessarias -->
    require_once __DIR__ ."/../config.php";
    require_once BASE_PATH . '/src/produto_crud.php';
    require_once BASE_PATH . '/src/utils.php';

    exigirLogin();

    // <!--  SECTION 17 - 12° BUSCAR PRODUTOS NO FILTRO -->
    $termo = sanitizar($_GET['search'] ?? "");
    


    // <!--  SECTION 17 - 3° Criar variaveis iniciais  -->
    $erro = null;
    // <!--  SECTION 17 - 13° erro focado no campo search -->
    $erroValidacaoBusca = null;
    $produtos = [];

    // <!--  SECTION 17 - 14° VALIDAÇÃO DO erroValidacaoBusca -->
    if(isset($_GET['search']) && $termo ===''){
     $erroValidacaoBusca = "Por favor, digite um termo no campo de busca";
    }

//     / <!--  SECTION 17 - 4° pegar os dados na variavel e ver se vai dar erro  -->
    try {
     $produtos = buscarProdutos($conexao, $termo);
    } catch (Throwable $e) {
     $erro = "Erro ao buscar produtos. Detahes: <br>".$e->getMessage();
    }

    

     $titulo = "Produtos |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-box-fill"></i> Produtos</h3>

      <!--  SECTION 17 - 5° erro aparecer no HTML (Qualque erro relacionado ao banco ) -->
     <?php if($erro): ?>
          <p class="alert alert-danger text-center">
               <?= $erro ?>
          </p>
     <?php endif; ?>

     <!--  SECTION 17 - 15° erro da filtragem aparecer no HTML (CAMPO DE BUSCA VAZIO) -->
     <?php if($erroValidacaoBusca): ?>
          <p class="alert alert-danger text-center">
               <?= $erroValidacaoBusca ?>
          </p>
     <?php endif; ?>

     <p>
          <a class="btn btn-primary" href="inserir.php">
              <i class="bi bi-plus-circle"></i> Adicionar Novo produto
          </a>
     </p>
     
     <form action="" method="get" class="mx-auto my-4">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <!--  SECTION 17 - 13° SUBSTITUIR O VALUE -->
                <input required class="form-control" type="search" name="search" id="search" placeholder="Buscar produto..." value="<?= $termo ?>">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary" type="submit"> 
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
     </form>
     
<!--  SECTION 17 - 16° mensagem para quando o filtro for utilizado -->
     <?php  if($termo !== ""):
               if(!empty($produtos)):
                    $mensagem = "<p class='text-muted'>Resultado para <b class='bg-info-subtle rounded p-1'>$termo</b></p>";
               else:
                    $mensagem = "<p class='text-danger'>Nenhum produto encontrado</p>";
               endif;

               echo $mensagem
          ?>
               <a href="listar.php" class="btn btn-sm btn-outline-secondary">&times; Limpar Busca</a>
     <?php endif;?>

     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
               <!--  SECTION 17 - 6° CONTADOR DE REGISTRO  -->
               <caption>Quantidade de resgistros: <?= count($produtos) ?></caption>
               <thead class="align-middle table-light">
                    <tr>
                         <th>Nome</th>
                         <th>Descrição</th>
                         <th>Fornecedor</th>
                         <th>Preço</th>
                         <th>Data de Validade</th>
                         <th colspan="2">Ações</th>
                    </tr>
               </thead>
               <tbody>
          <!--  SECTION 17 - 7° LOOP DE INFORMAÇÕES  -->
                    <?php foreach($produtos as $produto): ?>
                    <tr>
                         <td><?= $produto['nome'] ?></td>
                         <td><?= $produto['descricao'] ?></td>
                         <!--  SECTION 17 - 8° COMO IMPLEMENTAR DADOS ESTRANGEIROS (ir para o produto_curd) -->
                         <td><?= $produto['fornecedor'] ?></td>
                         <td><?= formatarPreço($produto['preco']) ?></td>
                         <td><?= formatarData($produto['data_validade']) ?></td>
                         <td><a class="btn btn-warning btn-sm" href="editar.php"><i class="bi bi-pencil-square"></i> Editar</a></td>
                         <td><a class="btn btn-danger btn-sm" href="excluir.php"><i class="bi bi-trash"></i> Excluir</a></td>
                    </tr>
                    <?php endforeach;?>
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>