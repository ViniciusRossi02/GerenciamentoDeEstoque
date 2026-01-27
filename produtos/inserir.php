 <?php

     // SECTION 18 - 1° PASSO - LINKAR AS PAGINAS IMPORTANTES 
     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . '/src/fornecedor_crud.php';
     require_once BASE_PATH . '/src/produto_crud.php';
     require_once BASE_PATH . '/src/utils.php';

     exigirLogin();

     // SECTION 18 - 3° PASSO -  VALIDAÇÕES DE ERRO, AGORA É DIFERENTE PQ SAO MUITOS CAMPOS E TEM POSSIBILIDADE DE VARIOS ERROS
     $erros = [];


     // SECTION 18 - 4° PASSO -  CAPTURANDO OS DADOS TODOS JUNTOS EM UM ARRAY ASSOCIATIVO PARA AGRUPAR OS DADOS
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $produto = [
               'nome' => sanitizar($_POST['nome']),
               'descricao' => sanitizar($_POST['descricao']) ?: null,
               'preco' => sanitizar($_POST['preco'], 'decimal'),
               'quantidade' => sanitizar($_POST['quantidade'], 'inteiro'),
               'fornecedor_id' => sanitizar($_POST['fornecedor_id'], 'inteiro')
          ];

          $detalhes = [
               'peso' => sanitizar($_POST['peso'], 'decimal') ?: null,
               'dimensoes' => sanitizar($_POST['dimensoes']) ?: null,
               'data_validade' => sanitizar($_POST['data_validade']) ?: null,
               'codigo_barras' => sanitizar($_POST['codigo_barras']) ?: null,
          ];

          // SECTION 18 - 5° PASSO -  VALIDAÇÃO DE CAMPO VAZIO (IFs INDEPENDENTES, PARA LIDAR COM VARIAS MENSAGENS AO MESMO TEMPO)
          if (empty($produto['nome'])) {
               $erros[] = "O nome é obrigatório";
          }

          if (empty($produto['fornecedor_id'])) {
               $erros[] = "Escolha um fornecedor";
          }

          if (trim($_POST['preco']) === '') {
               $erros[] = "O preço é obrigatório";
          } else if ($produto['preco'] < 0) {
               $erros[] = "informe um preço válido";
          }

          if (trim($_POST['quantidade']) === '') {
               $erros[] = "A quantidade é obrigatório";
          } else if ($produto['quantidade'] < 0) {
               $erros[] = "informe uma quantidade válida";
          }
     }


     $titulo = "Adicionar Produto |";
     require_once BASE_PATH . "/includes/cabecalho.php";


     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto</h3>

      <!-- // SECTION 18 - 6° PASSO - ERROS DINAMICOS MOSTRADOS NO HTML, CASO HOUVER  -->
      <?php if (!empty($erros)): ?>
           <div class="text-center">
                <ul class="list-group">
                     <?php foreach ($erros as $erro): ?>
                          <li class="list-group-item list-group-item-danger"><?= $erro ?></li>
                     <?php endforeach; ?>
                </ul>
           </div>
      <?php endif; ?>

      <!-- // SECTION 18 - 7° PASSO -  MELHORANDO A EXPERIENCIA DO USUARIO COM O VALUE -->
      <!-- Tabela de criação do produto -->
      <form action="" method="POST" class="w-75 mx-auto">
           <fieldset>
                <legend>Produto</legend>
                <div class="form-group mb-3">
                     <label for="nome" class="form-label">Nome:</label>
                     <input value='<?= $_POST['nome']?? '' ?>' type="text" name="nome" id="nome" class="form-control">
                </div>

                <div class="form-group mb-3">
                     <label for="descricao" class="form-label">Descrição:</label>
                     <textarea  class="form-control" id="descricao" name="descricao"><?= $_POST['nome']?? '' ?></textarea>
                </div>

                <div class="form-group mb-3">
                     <label for="preco" class="form-label">Preço:</label>
                     <input value='<?= $_POST['preco']?? '' ?>' type="number" name="preco" id="preco" class="form-control" min="0" step="0.01">
                </div>

                <div class="form-group mb-3">
                     <label for="quantidade" class="form-label">Quantidade:</label>
                     <input value='<?= $_POST['quantidade']?? '' ?>' type="number" name="quantidade" id="quantidade" class="form-control" min="0">
                </div>

                <div class="form-group mb-3">
                     <label for="fornecedor_id" class="form-label">Fornecedor:</label>
                     <select name="fornecedor_id" id="fornecedor_id" class="form-select">

                          <!-- // SECTION 18 - 2° PASSO - RENDERIZAR A LISTA DE PRODUTOS DE FORMA DINAMICA  -->
                          <option value=""></option>
                          <?php
                              $fornecedores = buscarFornecedores($conexao);
                              foreach ($fornecedores as $fornecedor): 
                                   // se o id do fornecedor atual no loop for o mesmo que foi enviado no formulario $_POST,
                                   // entao guardamos o atributo selected na variavel selecionado
                                   $selecionado = (isset($_POST['fornecedor_id']) && $_POST['fornecedor_id'] == $fornecedor['id']) ? 'selected' : '';
                              ?>
                               <option <?= $selecionado ?> value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>
                          <?php endforeach; ?>
                     </select>
                </div>
           </fieldset>

           <!-- Tabela de deatalhes do produto -->
           <fieldset class="mt-4">
                <legend>Detalhes do Produto</legend>
                <div class="form-group mb-3">
                     <label for="peso" class="form-label">Peso (kg):</label>
                     <input value='<?= $_POST['peso']?? '' ?>' type="number" name="peso" id="peso" class="form-control" step="0.01">
                </div>

                <div class="form-group mb-3">
                     <label for="dimensoes" class="form-label">Dimensões (LxAxP):</label>
                     <input value='<?= $_POST['dimensoes'] ?? '' ?>' type="text" name="dimensoes" id="dimensoes" class="form-control">
                </div>

                <div class="form-group mb-3">
                     <label for="codigo_barras" class="form-label">Código de barras: </label>
                     <input value='<?= $_POST['codigo_barras']?? '' ?>' type="text" name="codigo_barras" id="codigo_barras" class="form-control">
                </div>

                <div class="form-group mb-3">
                     <label for="data_validade" class="form-label">Data de validade: </label>
                     <input value='<?= $_POST['data_validade']?? '' ?>' type="date" name="data_validade" id="data_validade" class="form-control">
                </div>

           </fieldset>

           <button class="btn btn-success my-4" type="submit">
                <i class="bi bi-check-circle "></i> Salvar
           </button>
      </form>


 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>