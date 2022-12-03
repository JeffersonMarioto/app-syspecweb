<?php
define('HOST', 'us-cdbr-east-06.cleardb.net');
define('USUARIO', 'bb5a7d8e29efca');
define('SENHA', '9da1d24d');
define('DB', 'heroku_302e836d67b7647');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>