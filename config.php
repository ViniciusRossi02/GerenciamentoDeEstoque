<?php
// Garante caminhos absolutos corretos ao incluir arquivos (includes, src...) resolve caminhos de arquivos
// mesmo quando voce esta em subpastas
define('BASE_PATH', __DIR__);

// garante URLs corretas ao gerar links (ex: login.php, fornecedores/listar.php)
define('BASE_URL', '/curso-php-crud');

// Importando/Carregando o script de conexão e disponibilizando para todas as paginas que utilizam o config.php
require_once BASE_PATH . '/src/banco.php';