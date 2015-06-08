<?php
 $select_clientes = 'SELECT * FROM cadastro_clientes';
						try{
							$query_honorario = $conecta->prepare($select_clientes);
							$query_honorario->execute();
							$result_client_honorario = $query_honorario->fetchAll(PDO::FETCH_ASSOC);
							$count = $query_honorario->rowCount(PDO::FETCH_ASSOC);
							}catch(PDOexception $erro_client){
								echo $erro_client->getMessage();
								}
							foreach($result_client_honorario as $res_client_honorario){
								$id_client_honorario = $res_client_honorario['cliente_id'];
								
								
							
		
								/////////////////cadastro de meses e ano atual na tabala de honorarios
$ano_atual = date('Y');
$sql_busca_ano_atual = 'SELECT * FROM honorario_mes WHERE mes_ano_atual = :mes_ano_atual AND mes_id_cliente = :mes_id_cliente';
try{
	$query_busca_ano_atual = $conecta->prepare($sql_busca_ano_atual);
	$query_busca_ano_atual->bindValue(':mes_ano_atual',$ano_atual,PDO::PARAM_STR);
	$query_busca_ano_atual->bindValue(':mes_id_cliente',$id_client_honorario,PDO::PARAM_STR);
	$query_busca_ano_atual->execute();
	
	$resultado_busca_ano_atual = $query_busca_ano_atual->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erro_busca_ano_atual){
		echo $erro_busca_ano_atual->getMessage();}
	foreach($resultado_busca_ano_atual as $res_busca_ano_atual){
		$honorario_ano_atual = $res_busca_ano_atual['mes_ano_atual'];
		$honorario_id_cliente = $res_busca_ano_atual['mes_id_cliente'];
		$honorario_mes_nome = $res_busca_ano_atual['mes_nome'];
		
		}
if($honorario_ano_atual == '' or $honorario_id_cliente != $id_client_honorario and $honorario_mes_nome == 0){	
$mes = array('Jan', 'Fev', 'Mar' ,'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
for($i = 0 ;$i < 12; $i++){
$ano = date('Y');
$mes_pago = 'nao';
$cadastro_mes_honorario = 'INSERT INTO honorario_mes (mes_nome, mes_ano_atual, mes_id_cliente , mes_pago) VALUES (:mes_nome, :mes_ano_atual, :mes_id_cliente, :mes_pago)';
	try{
	$query_cadastro_mes_honorario = $conecta->prepare($cadastro_mes_honorario);
	$query_cadastro_mes_honorario->bindValue(':mes_nome',$mes[$i].'/'.$ano_atual,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->bindValue(':mes_ano_atual',$ano_atual,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->bindValue(':mes_id_cliente',$id_client_honorario,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->bindValue(':mes_pago',$mes_pago,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->execute();
	
	}catch(PDOexception $erro_cadastro_mes_honorario){
		echo'Erro ao localizar outras datas'.$erro_cadastro_mes_honorario->getMessage();
		}}}}



?>