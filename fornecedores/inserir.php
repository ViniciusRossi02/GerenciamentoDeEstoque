 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Adicionar Fornecedor |";
     // <!-- SECTION 15 - 10° PASSO - linkar as paginas com as funções e a pagina util caso queira usar algum recurso  -->
    require_once BASE_PATH ."/includes/cabecalho.php";
    require_once BASE_PATH . "/src/fornecedor_crud.php";
    require_once BASE_PATH . "/src/utils.php";

    exigirLogin();

    // <!-- SECTION 15 - 11° PASSO - fazer a tratativa de error  -->
    $erro = null;

    // <!-- SECTION 15 - 12° PASSO - Pegar os dados que o formulario enviar  -->
    if($_SERVER["REQUEST_METHOD"] === "POST")
     {
          $nome = sanitizar($_POST['nome']);

          // <!-- SECTION 15 - 13° PASSO - validar se tem algum dado (se nome estiver vazio...) -->
          if(empty($nome))
          {
               $erro = "Preencha o campo nome!";

          } else {
               try {
                    inserirFornecedor($conexao, $nome);
                    header('location:listar.php');
                    exit;
               } catch (Throwable $e) {
                    $erro = "Erro ao inserir fornecedor".$e->getMessage();
               }
          }
     }
?>

<section class=" mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Fornecedor</h3>

      <!-- SECTION 15 - 14° PASSO - INSERIR MENSAGEM DE ERRO NA PAGINA HTML -->
     <?php if($erro): ?>
          <p class="alert alert-danger text-center">
               <?= $erro ?>
          </p>
     <?php endif; ?>
     
     <form action="" method="POST" class="w-75 mx-auto">
          <div class="form-group">
                <!-- SECTION 15 - 15° PASSO - ISERIR O VALUE PARA MOSTRAR O NOME DO INDIVIDUO, CASO NAO HAJA, MOSTRA VAZIO-->
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" name="nome" id="nome" class="form-control" value="<?= $_POST['nome'] ?? '' ?>">
          </div>
          <button class="btn btn-success my-4" type="submit">
               <i class="bi bi-check-circle "></i> Salvar
          </button>
     </form>


</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>