<?php
// Garante caminhos absolutos corretos ao incluir arquivos (includes, src...) resolve caminhos de arquivos
// mesmo quando voce esta em subpastas
define('BASE_PATH', __DIR__);

// garante URLs corretas ao gerar links (ex: login.php, fornecedores/listar.php)
define('BASE_URL', '/curso-php-crud');