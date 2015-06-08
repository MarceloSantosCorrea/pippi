<?php
//define('HOST','mysql.brunopippi.cnt.br');
//define('DB','brunopippi_cnt_br');
//define('USER','brunopippicntbr');
//define('PASS','bruno2012');
define('HOST','localhost');
define('DB','pippi');
define('USER','root');
define('PASS','');

$conexao = 'mysql:host='.HOST.';dbname='.DB;

try{
	$conecta = new PDO($conexao,USER,PASS);
	$conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOexception $error_conecta){
	echo'Erro ao Conectar com o Banco de Dados. Favor entrar em contato em: marcelo_tec_informatica@yahoo.com.br';
	}
?>