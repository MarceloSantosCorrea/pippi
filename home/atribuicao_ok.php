<?php
include_once('Connections/config_pdo.php');
if(!empty($_GET['atribuicao']) and !empty($_GET['cliente'])){
$id_atribuicao = $_GET['atribuicao'];
$id_cliente = $_GET['cliente'];
$sql_atri_obrig = 'SELECT * FROM atribuicao_cliente_obrigacao WHERE atribuicao_id = :id_atribuicao';//buscando pelo id do cliente
try{
	$query_atri_obrig = $conecta->prepare($sql_atri_obrig);
	$query_atri_obrig->bindValue(':id_atribuicao',$id_atribuicao,PDO::PARAM_STR);
	$query_atri_obrig->execute();
	$result_atri_obrig = $query_atri_obrig->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erro_atri_obrig){
		echo 'Erro ao selecionar a atribuicao e obrigacao';
		}
	foreach($result_atri_obrig as $res_atri_obrig){
		$atribuicao_id = $res_atri_obrig['atribuicao_id'];
		$atribuicao_id_cliente = $res_atri_obrig['atribuicao_id_cliente'];
		$atribuicao_id_obrigacao = $res_atri_obrig['atribuicao_id_obrigacao'];
		$atribuicao_status = $res_atri_obrig['atribuicao_status'];
		$atribuicao_nome_obrigacao = $res_atri_obrig['atribuicao_nome_obrigacao'];
	}
	
if($atribuicao_status == 'sim'){ $status = 'nao';}elseif($atribuicao_status == 'nao'){ $status = 'sim';}

$sql_update_atribuicao = 'UPDATE atribuicao_cliente_obrigacao SET atribuicao_status = :atribuicao_status 
							WHERE atribuicao_id = :atribuicao_id';
try{
	$query_update_atribuicao = $conecta->prepare($sql_update_atribuicao);
	$query_update_atribuicao->bindValue(':atribuicao_status',$status,PDO::PARAM_STR);
	$query_update_atribuicao->bindValue(':atribuicao_id',$id_atribuicao,PDO::PARAM_STR);
	$query_update_atribuicao->execute();
	echo'
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/atribuicao&cliente='.$atribuicao_id_cliente.'">
	<script type="text/javascript">
	alert("Atualizado com Sucesso.");
	</script>
	';
	}catch(PDOexception $erro_update_atribuicao){
		echo'erro ao atualizar atribuicoes'.$erro_update_atribuicao->getMessage();
	}
}
if(!empty($_GET['cliente']) and !empty($_GET['all'])){
$cliente = $_GET['cliente'];
$status = $_GET['all'];
$sim = 'sim';
$nao = 'nao';
if($status == 'ativar'){
$sql_update_atribuicao = 'UPDATE atribuicao_cliente_obrigacao SET atribuicao_status = :atribuicao_status WHERE atribuicao_id_cliente = :atribuicao_id_cliente';
try{
	$query_update_atribuicao = $conecta->prepare($sql_update_atribuicao);
	$query_update_atribuicao->bindValue(':atribuicao_status',$sim,PDO::PARAM_STR);
	$query_update_atribuicao->bindValue(':atribuicao_id_cliente',$cliente,PDO::PARAM_STR);
	$query_update_atribuicao->execute();
	echo'<script type="text/javascript">
	alert("Atualizado com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/atribuicao&cliente='.$cliente.'">
	';
	}catch(PDOexception $erro_update_atribuicao){
		echo'erro ao atualizar atribuicoes'.$erro_update_atribuicao->getMessage();
	}
}elseif($status == 'desativar'){
$sql_update_atribuicao = 'UPDATE atribuicao_cliente_obrigacao SET atribuicao_status = :atribuicao_status WHERE atribuicao_id_cliente = :atribuicao_id_cliente';
try{
	$query_update_atribuicao = $conecta->prepare($sql_update_atribuicao);
	$query_update_atribuicao->bindValue(':atribuicao_status',$nao,PDO::PARAM_STR);
	$query_update_atribuicao->bindValue(':atribuicao_id_cliente',$cliente,PDO::PARAM_STR);
	$query_update_atribuicao->execute();
	echo'<script type="text/javascript">
	alert("Atualizado com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/atribuicao&cliente='.$cliente.'">
	';
	}catch(PDOexception $erro_update_atribuicao){
		echo'erro ao atualizar atribuicoes'.$erro_update_atribuicao->getMessage();
	}
	}
}
?>

