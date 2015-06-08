<?php include_once('Connections/config_pdo.php');?>
<?php
session_start();
$logado_nivel = $_SESSION['MM_Username'];
$sql_select_nivel = 'SELECT * FROM login WHERE login_login = :logado_nivel';
try{
	$query_select_nivel = $conecta->prepare($sql_select_nivel);
	$query_select_nivel->bindValue(':logado_nivel',$logado_nivel,PDO::PARAM_STR);
	$query_select_nivel->execute();
	$result_nivel = $query_select_nivel->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select_nivel){
	echo'Erro ao selecionar';
	}
	foreach ($result_nivel as $res_nivel){
	 	$login_nivel = $res_nivel['login_nivel'];	
	}
if($login_nivel == 'admin' or $login_nivel == 'tecnico'){
include'admin.php';
}
if($login_nivel == 'usuario'){
include'admin.php';	
}
?>