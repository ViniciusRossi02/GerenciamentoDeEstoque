<!-- SECTION 13 - PASSO 1 -  -->
 <?php
//  Sobre sessao (SESSION) no PHP é um recurso que permite armazenar informações do usuario enquanto ele navega entre as páginas
// essas informações são mantidas no servidor de maneira temporaria.
// Ex de informações: dados do usuario lojado(nome, identificador, tipo de usuario); dados tempoararios de carrinho de compras;
// Preferencias do ususario (tema, idioma, configurações personalizadas); Controle de acesso em geral


// Iniciar uma sessao caso nao esteja iniciada
function iniciarSessao(): void
{
    // Se a sessap nao estiver ativa, iniciar a sessao
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
}

function exigirLogin():void
{
    iniciarSessao();

    // Se nao tiver o id do usuario na sessao, redirecionar para a pagina de login
    // Verificando se não existe uma variavel de sessão chamada 'id'(identificador de algum usuario logado)
    if(!isset($_SESSION['id']))
        {
            header("location:".BASE_URL."/login.php?acesso_proibido");
            exit;
        }
}

// <!-- SECTION 13 - PASSO 2 - adicionar require no config.php e depois em todas as paginas  -->

// SECTION 13 - PASSO 4 - Crian função Usuario estar logado

// Logica da função - Hora que for chamada, ela vai verificar se existe uma variavel de sessao chamada id (portanto, se alguem logou)
// Se logou retorna TRUE
function usuarioEstaLogado(): bool
{
    iniciarSessao();
    return isset($_SESSION['id']);
}