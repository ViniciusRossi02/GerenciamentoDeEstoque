 <?php
     // SECTION 28 - 2° PASSO -> CHAMAR PAGINAS QUE SERAO USADAS
     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . "/src/relatorio_crud.php";
     require_once BASE_PATH . "/src/fornecedor_crud.php";
     require_once BASE_PATH . "/src/utils.php";

     exigirLogin();

     // SECTION 28 - 3° PASSO -> VARIAVEIS PARA COLETAR ERROS, FORNECEDORES E PRODUTOS

     $fornecedores = [];
     $produtos = [];
     $erro = null;

     $fornecedor_id = sanitizar($_GET["fornecedor_id"] ?? null, 'inteiro');

     // SECTION 28 - 4° PASSO -> VALIDAÇÃO
     try {
          $fornecedores = buscarFornecedores($conexao);
     } catch (Throwable $e) {
          $erro = "Erro ao buscar fornecedores. <br>" . $e->getMessage();
     }

     // SECTION 28 - 8° PASSO -> VALIDAÇÃO PARA VER SE EXISTE VALOR NO ID E ACHAR FORNECEEDOR
     // SE FOR NULA NAO VAI BUSCAR PRODUTO POR FONECEDOR

     try {
          $produtos = $fornecedor_id ? buscarProdutosPorForncedor($conexao, $fornecedor_id) : [];
     } catch (Throwable $e) {
          $erro = "Erro ao buscar produtos. <br>" . $e->getMessage();
     }

     $titulo = "Produtos por Fornecedor |";
     require_once BASE_PATH . "/includes/cabecalho.php";


     ?>

 <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3><i class="bi bi-people"></i> Produtos Por Fornecedor</h3>

      <!-- // SECTION 28 - 5° PASSO -> MOSTRAR ERRO NO HTML -->
      <?php if ($erro): ?>
           <p class="alert alert-danger text-center"><?= $erro ?></p>
      <?php endif; ?>


      <!-- // SECTION 28 - 9° PASSO -> So mostrar o formulario se tiver fornecedor -->
      <?php if ($fornecedores): ?>
           <form action="" method="get" class="mx-auto my-4">
                <div class="row g-2 justify-content-center">
                     <div class="col-auto">
                          <label for="fornecedor_id" class="text-muted col-form-label">Selecione o Fornecedor:</label>
                     </div>
                     <div class="col-auto">
                          <!-- // SECTION 28 - 6° PASSO -> UTILIZAR JS PARA UTILIZAR O FORMULARIO SEM USAR BOTAO -->
                          <select
                               onchange="this.form.submit()"
                               name="fornecedor_id" id="fornecedor_id" class="form-select">
                               <option value=""></option>
                               <!-- // SECTION 28 - 7° PASSO -> FOREACH PARA APARECER OS FORNECEDORES NO SELECT -->
                               <?php foreach ($fornecedores as $fornecedor): ?>
                                    <option
                                         <?= $fornecedor['id'] === $fornecedor_id ? 'selected' : '' ?>
                                         value="<?= $fornecedor['id'] ?>">
                                         <?= $fornecedor['nome'] ?>
                                    </option>
                               <?php endforeach; ?>
                          </select>
                     </div>
                </div>
           </form>
      <?php else: ?>
           <p class="alert alert-warning">Nenhum fornecedor cadastrado ainda</p>
      <?php endif; ?>

      <!-- // SECTION 28 - 8° PASSO -> Só aaprecer a tabela caso tenha fornecedor e se nao tiver um aviso-->
      <?php if ($fornecedor_id && $produtos): ?>
           <p class="fw-semibold">Produtos fornecidos por este fornecedor:</p>

           <div class="table-responsive">
                <table class="table table-hover text-center caption-top">
                     <caption>Quantidade de resgistros: <?= COUNT($produtos) ?></caption>
                     <thead class="align-middle table-light">
                          <tr>
                               <th>Nome</th>
                               <th>Descrição</th>
                               <th>Preço</th>
                               <th>Quantidade</th>
                               <th>Total</th>
                               <th>Ação</th>
                          </tr>
                     </thead>
                     <tbody>
                          <!-- // SECTION 28 - 7° PASSO -> Deixar a tabela dinamica e link para o editar -->
                          <?php foreach ($produtos as $produto): ?>
                               <tr>
                                    <td><?= $produto['nome'] ?></td>
                                    <td><?= $produto['descricao'] ?></td>
                                    <td><?= formatarPreço($produto['preco']) ?></td>
                                    <td><?= $produto['quantidade'] ?></td>
                                    <td><?= formatarPreço($produto['total']) ?></td>
                                    <td>
                                         <a class="btn btn-warning btn-sm"
                                              href="../produtos/editar.php?id=<?= $produto['id'] ?>">
                                              <i class="bi bi-pencil-square"></i> Editar
                                         </a>
                                    </td>
                               <?php endforeach; ?>
                     </tbody>
                </table>
           </div>
      <?php elseif ($fornecedor_id): ?>
           <p class="alert alert-warning">Nenhum produto encontrado para este fornecedor</p>
      <?php endif; ?>
 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>