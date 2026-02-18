 <?php
     // SECTION 29 - 2° PASSO -> Linkar paginas
     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . "/src/produto_crud.php";
     require_once BASE_PATH . "/src/relatorio_crud.php";
     require_once BASE_PATH . "/src/utils.php";


     exigirLogin();
     // SECTION 29 - 3° PASSO -> VARAIVEIS DE ERRO
     $produto_id = sanitizar($_GET['produto_id'] ?? null, "inteiro");
     $produtos = [];
     $estoques = [];
     $erro = null;

     // SECTION 29 - 4° PASSO -> TRY/CATCH DE VALIDAÇÃO
     try {
          // buscar no BD e em ordem descrescente de ID (como esta na função original)
          $produtos = buscarProdutos($conexao);

          // SECTION 29 - 6° PASSO -> ORDENAR PRODUTO EM ORDEM ALFABETICA USANDO PHP
          $nomeProdutos = array_column($produtos, "nome"); // gera um no array apenas com a coluna nome

          // ordena o array de produtos pelo nome
          array_multisort($nomeProdutos, SORT_ASC, $produtos);
     } catch (Throwable $e) {
          $erro = "Erro ao buscar produtos. <br>" . $e->getMessage();
     }

     try {
          $estoques = $produto_id ? buscarEstoquePorProduto($conexao, $produto_id) : [];
          
     } catch (Throwable $e) {
          $erro = "Erro ao buscar estoque. <br>".$e->getMessage();
     }


     $titulo = "Estoque por Produto |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3><i class="bi bi-clipboard-data"></i> Estoque por Produto</h3>
 <!-- // SECTION 29 - 7° PASSO ->  Variavel para aparecer o erro no HTML-->
      <?php if($erro): ?>
          <p class="alert alert-danger text-center"><?= $erro ?></p>
      <?php endif; ?>

      <!-- // SECTION 29 - 13° PASSO -> IF caso a aplicação esteja no comeco e nao tenha nenhum produto cadastrado. -->
      <?php if($produtos): ?>
          <form action="" method="get" class="mx-auto my-4">
           <div class="row g-2 justify-content-center">
                <div class="col-auto">
                     <label for="produto_id" class="text-muted col-form-label">Selecione o Produto</label>
                </div>
                <div class="col-auto">
                     <!-- // SECTION 29 - 8° PASSO -> Pequeno JS para enviar o formulario sem botão -->
                     <select onchange="this.form.submit()"
                     name="produto_id" id="produto_id" class="form-select">
                          <option value=""></option>

                          <!-- // SECTION 29 - 5° PASSO -> LISTA DINAMICA -->
                          <?php foreach ($produtos as $produto): ?>
                               <option value="<?= $produto['id'] ?>" 
                               <?= $produto['id'] === $produto_id ? 'selected' : '' ?>
                               >
                                    <?= $produto['nome'] ?>
                               </option>
                          <?php endforeach; ?>

                     </select>
                </div>
           </div>
      </form>
       <?php else: ?>
          <p class="alert alert-warning text-center">Nenhum produto cadastrado ainda.</p>
       <?php endif; ?>
      

     <!-- // SECTION 29 - 9° PASSO -> Mostrat formulario se tiver produto e estoque -->
     <?php if($produto_id && $estoques): ?>
      <p class="fw-semibold">Estoque deste produto:</p>

      <div class="table-responsive">
           <table class="table table-hover text-center caption-top">
                <caption>Quantidade de resgistros: <?= COUNT($estoques)?></caption>
                <thead class="align-middle table-light">
                     <tr>
                          <th>Loja</th>
                          <th>Estoque</th>
                          <th>Ação</th>
                     </tr>
                </thead>
                <tbody>
               <!-- // SECTION 29 - 10° PASSO -> formulario dinamico -->
                    <?php foreach($estoques AS $estoque): ?>
                     <tr>
                          <td><?= $estoque['loja'] ?></td>
                          <td><?= $estoque['estoque'] ?></td>
                          <td>
               <!-- // SECTION 29 - 11° PASSO -> link para o editar -->
                              <a class="btn btn-warning btn-sm "
                               href="../estoque/editar.php?loja_id=<?= $estoque['loja_id']?>&produto_id=<?= $estoque['produto_id'] ?>">
                                  <i class="bi bi-pencil-square"></i> Editar
                              </a>
                          </td>
                    </tr>
                     <?php endforeach; ?>     
                </tbody>
           </table>
      </div>
     <!-- // SECTION 29 - 12° PASSO -> caso de erro a mensagem -->
      <?php elseif($produto_id):?>
          <p class="alert alert-warning">Nenhum registro de estoque foi encontrado</p>
      <?php endif; ?>
 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>