 <?php

     require_once __DIR__ . "/../config.php";
     require_once BASE_PATH . '/src/fornecedor_crud.php';
     require_once BASE_PATH . '/src/produto_crud.php';
     require_once BASE_PATH . '/src/utils.php';



     exigirLogin();

     // <!--  SECTION 20 3° PASSO - EXIBIR OS ERROS -->
     $id = sanitizar($_GET['id'], 'inteiro');
     $erros = [];

     if (!$id) {
          header("Location: listar.php");
          exit;
     }

     try {
          $produto = buscarProdutoPorId($conexao, $id);
          if (!$produto) $erros[] = "Produto não encontrado";
     } catch (Throwable $e) {
          $erros[] = "Erro ao buscar produto. <br>" . $e->getMessage();
     }


     // <!--  SECTION 21 1° PASSO - COLETAR OS DADOS PARA EDITAR CASO QUEIRA -->
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Coletar os dados do formulario
          $produtoAtualizado = [
               'nome' => sanitizar($_POST['nome']),
               'descricao' => sanitizar($_POST['descricao']) ?: null,
               'preco' => sanitizar($_POST['preco'], 'decimal'),
               'quantidade' => sanitizar($_POST['quantidade'], 'inteiro'),
               'fornecedor_id' => sanitizar($_POST['fornecedor_id'], 'inteiro'),
               'id' => $id,  //Importante ter o ID do produto visando o processo de update no banco
          ];

          $detalhesAtualizados = [
               'peso' => sanitizar($_POST['peso'], 'decimal') ?: null,
               'dimensoes' => sanitizar($_POST['dimensoes'],) ?: null,
               'codigo_barras' => sanitizar($_POST['codigo_barras']) ?: null,
               'data_validade' => sanitizar($_POST['data_validade']) ?: null,
               'produto_id' => $id, //Importante ter o ID do produto visando o processo de update no banco
          ];

          // SECTION 21 - 2° PASSO -  VALIDAÇÃO DE CAMPO VAZIO (IFs INDEPENDENTES, PARA LIDAR COM VARIAS MENSAGENS AO MESMO TEMPO)
          if (empty($produtoAtualizado['nome'])) {
               $erros[] = "O nome é obrigatório";
          }

          if (empty($produtoAtualizado['fornecedor_id'])) {
               $erros[] = "Escolha um fornecedor";
          }

          if (trim($_POST['preco']) === '') {
               $erros[] = "O preço é obrigatório";
          } else if ($produtoAtualizado['preco'] < 0) {
               $erros[] = "informe um preço válido";
          }

          if (trim($_POST['quantidade']) === '') {
               $erros[] = "A quantidade é obrigatório";
          } else if ($produtoAtualizado['quantidade'] < 0) {
               $erros[] = "informe uma quantidade válida";
          }
// <!--  SECTION 21 3° PASSO - VERIFICAR ERROS E FAZERA FUNÇÃO DE ATUALIZAR   -->
          if (empty($erros)) {
               try {
                    $conexao->beginTransaction();

                    atualizarProduto($conexao, $produtoAtualizado);

                    // VERIFICAR SE JÁ EXISTE DETALHES PARA ESSE PRODUTO
                    $temDetalhes = !empty($produto['detalhe_id']);
                    
                    // VERIFICAR SE O USUARIO DIGITOU ALGUM DETALHE
                    $detalhesDigitados = !empty(array_filter([
                         $detalhesAtualizados['peso'],
                         $detalhesAtualizados['dimensoes'],
                         $detalhesAtualizados['codigo_barras'],
                         $detalhesAtualizados['data_validade']
                    ]));

                    // SE JÁ TEM DETALHES DO PRODUTO, ENTAO ATUALIZAMOS O REGISTRO DE DETALHES
                    if($temDetalhes){
                         atualizarDetalhesDoProduto($conexao, $detalhesAtualizados);
                    }else if($detalhesDigitados){
                         // SE NÃO TEM DETALHES, MAS O USUARIO DIGITOU ALGUM, ENTAO INSERIMOS UM NOVO REGISTRO DE DETALHES
                         inserirDetalhesDoProduto($conexao, $detalhesAtualizados);

                    }

                    $conexao->commit();
                    header('location:listar.php');
                    exit; 

               } catch (Throwable $e) {
                    $conexao->rollBack();

                    if ($e->getCode() === '23000') {
                         $erros[] = "O código de barras já existe no sistema.";
                    } else {
                         $erros[] = "Erro ao inserir produto: <br>" . $e->getMessage();
                    }
               }
          }
     }



     $titulo = "Editar Produto |";
     require_once BASE_PATH . "/includes/cabecalho.php";
     ?>

 <section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
      <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Produto</h3>
      <!--  SECTION 20 3° PASSO - FAZER APARECER O ERRO NO HTML -->
      <?php if (!empty($erros)): ?>
           <div class="text-center">
                <ul class="list-group">
                     <?php foreach ($erros as $erro): ?>
                          <li class="list-group-item list-group-item-danger"><?= $erro ?></li>
                     <?php endforeach; ?>
                </ul>
           </div>
      <?php endif; ?>

      <!-- Tabela de criação do produto -->
      <form action="" method="POST" class="w-75 mx-auto">
           <fieldset>
                <legend>Produto</legend>
                <!--  SECTION 20 4° PASSO - FORMULARIO INVISIVEL PARA COLETAR O ID (EVITAR ERROS) -->
                <input type="hidden" name="id" value="<?= $produto['produto_id'] ?? '' ?>">
                <!--  SECTION 20 6° PASSO - TROCAR OS DADOS ESTATICOS PARA DINAMICOS AO ABIR O FORMULARIO -->
                <div class="form-group mb-3">
                     <label for="nome" class="form-label">Nome:</label>
                     <input required type="text" name="nome" id="nome" class="form-control" value="<?= $produto['nome'] ?? '' ?>">
                </div>

                <div class="form-group mb-3">
                     <label for="descricao" class="form-label">Descrição:</label>
                     <textarea class="form-control" id="descricao" name="descricao"><?= $produto['descricao'] ?? '' ?></textarea>
                </div>

                <div class="form-group mb-3">
                     <label for="preco" class="form-label">Preço:</label>
                     <input required value="<?= $produto['preco'] ?? '' ?>" type="number" name="preco" id="preco" class="form-control" min="0" step="0.01">
                </div>

                <div class="form-group mb-3">
                     <label for="quantidade" class="form-label">Quantidade:</label>
                     <input required value="<?= $produto['quantidade'] ?? '' ?>" type="number" name="quantidade" id="quantidade" class="form-control" min="0">
                </div>

                <div class="form-group mb-3">
                     <label for="fornecedor_id" class="form-label">Fornecedor:</label>
                     <select required name="fornecedor_id" id="fornecedor_id" class="form-select">
                          <!--  SECTION 20 08° PASSO - FAZER A LISTA DE FORNECEDORES DINAMICA -->
                          <option value=""></option>

                          <?php $fornecedores = buscarFornecedores($conexao);
                              foreach ($fornecedores as $fornecedor):
                                   // SE O FORNCEDOR FOR O MESMO DO PRODUTO, MARCAMOS COMO SELECIONADO, SE NAO, NAO MARCAMOS NADA
                                   $selecionado = ($fornecedor['id'] === $produto['fornecedor_id']) ? 'selected' : '';
                              ?>
                               <option value="<?= $fornecedor['id'] ?>" <?= $selecionado ?>><?= $fornecedor['nome'] ?></option>
                          <?php endforeach; ?>
                     </select>
                </div>
           </fieldset>
 
           <!-- Tabela de deatalhes do produto -->
           <fieldset class="mt-4">
                <legend>Detalhes do Produto</legend>
                <!--  SECTION 20 5° PASSO - FORMULARIO INVISIVEL PARA COLETAR O ID (EVITAR ERROS) -->
                <input type="hidden" name="detalhe_id" value="<?= $produto['detalhe_id'] ?? '' ?>">
                <!--  SECTION 20 7° PASSO - TROCAR OS DADOS ESTATICOS PARA DINAMICOS AO ABIR O FORMULARIO -->
                <div class="form-group mb-3">
                     <label for="peso" class="form-label">Peso (kg):</label>
                     <input value="<?= $produto['peso'] ?? '' ?>" type="number" name="peso" id="peso" class="form-control" step="0.01">
                </div>

                <div class="form-group mb-3">
                     <label for="dimensoes" class="form-label">Dimensões (LxAxP):</label>
                     <input value="<?= $produto['dimensoes'] ?? '' ?>" type="text" name="dimensoes" id="dimensoes" class="form-control">
                </div>

                <div class="form-group mb-3">
                     <label for="codigo_barras" class="form-label">Código de barras: </label>
                     <input value="<?= $produto['codigo_barras'] ?? '' ?>" type="text" name="codigo_barras" id="codigo_barras" class="form-control">
                </div>

                <div class="form-group mb-3">
                     <label for="data_validade" class="form-label">Data de validade: </label>
                     <input value="<?= $produto['data_validade'] ?? '' ?>" type="date" name="data_validade" id="data_validade" class="form-control">
                </div>

           </fieldset>

           <button class="btn btn-warning my-4" type="submit">
                <i class="bi bi-arrow-clockwise "></i> Salvar Alterações
           </button>
      </form>


 </section>

 <?php require_once BASE_PATH . "/includes/rodape.php"; ?>