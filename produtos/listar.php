 <?php

    require_once __DIR__ ."/../config.php";
     $titulo = "Produtos |";
    require_once BASE_PATH ."/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
     <h3><i class="bi bi-box-fill"></i> Produtos</h3>
     <p>
          <a class="btn btn-primary" href="inserir.php">
              <i class="bi bi-plus-circle"></i> Adicionar Novo produto
          </a>
     </p>
     
     <form action="" method="get" class="mx-auto my-4">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <input class="form-control" type="search" name="search" id="search" placeholder="Buscar produto..." value="Termo a ser buscado">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary" type="submit"> 
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
     </form>

     <div class="table-responsive">
          <table class="table table-hover text-center caption-top">
               <caption>Quantidade de resgistros: 0</caption>
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
                    <tr>
                         <td>Ultrabook</td>
                         <td>Equipamento de ultima geração</td>
                         <td>Asus</td>
                         <td>3499</td>
                         <td>21/12/2005</td>
                         <td><a class="btn btn-warning btn-sm" href="editar.php"><i class="bi bi-pencil-square"></i> Editar</a></td>
                         <td><a class="btn btn-danger btn-sm" href="excluir.php"><i class="bi bi-trash"></i> Excluir</a></td>
                    </tr>
               </tbody>
          </table>
     </div>
</section>

<?php require_once BASE_PATH ."/includes/rodape.php"; ?>