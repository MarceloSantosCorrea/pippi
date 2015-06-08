<?php
$sql_md5_obrigacao = mysql_query("SELECT * FROM cadastro_obrigacao GROUP BY obrigacao_md5") or die(mysql_error());

	while($res_md5_obrigacao = mysql_fetch_array($sql_md5_obrigacao)){
		$obrigacao_md5 = $res_md5_obrigacao['obrigacao_md5'];
		$obrigacao_nome = $res_md5_obrigacao['obrigacao_nome'];

$sql_id_cliente = mysql_query("SELECT * FROM cadastro_clientes") or die (mysql_error()); 
	while($res_id_cliente = mysql_fetch_array($sql_id_cliente)){
		$cliente_id = $res_id_cliente['cliente_id'];
		
///evitar cadastro repetido
$sql_cadastro_repetido = mysql_query("SELECT * FROM atribuicao_cliente_obrigacao WHERE atribuicao_id_cliente = '$cliente_id' AND atribuicao_id_obrigacao = '$obrigacao_md5'") or die (mysql_error());
if(@mysql_num_rows($sql_cadastro_repetido) <= 0){		
		
$atribuicao_status = 'nao';
$sql_cadastra_atribuicao = mysql_query("INSERT INTO atribuicao_cliente_obrigacao (atribuicao_id_cliente, atribuicao_id_obrigacao, atribuicao_status, atribuicao_nome_obrigacao) 
                                             VALUES ('$cliente_id', '$obrigacao_md5', '$atribuicao_status', '$obrigacao_nome')") or die (mysql_error());

		
}//fecha a condicao de contagem de cadastros
		
	}//fecha o 'foreach($result_id_cliente as $res_id_cliente)'
		
}//fecha o 'foreach($result_md5_obrigacao as $res_md5_obrigacao)'
?>