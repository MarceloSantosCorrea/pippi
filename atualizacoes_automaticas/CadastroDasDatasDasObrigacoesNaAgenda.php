<?php 
///////////cadatro de obrigação na agenda
$sql_busca_obrigacao = mysql_query("SELECT * FROM cadastro_obrigacao") or die (mysql_error());
	while($res_busca_obrigacao = mysql_fetch_array($sql_busca_obrigacao)){
			$obrigacao_id = $res_busca_obrigacao['obrigacao_id'];
			$obrigacao_nome = $res_busca_obrigacao['obrigacao_nome'];
			$obrigacao_data = $res_busca_obrigacao['obrigacao_data'];
$agenda_tipo = 'obrigacao';	
$data_invertida = substr($obrigacao_data,6,4)."-".substr($obrigacao_data,3,2)."-".substr($obrigacao_data,0,2).'<br />';//inverte a data da tabela obrigacao para comparar com o campo date da tebela pagina_agenda
$sql_busca_obrigacao_agenda = mysql_query("SELECT * FROM pagina_agenda WHERE agenda_data = '$data_invertida' AND agenda_evento = '$obrigacao_nome' AND agenda_tipo = '$agenda_tipo'") or die (mysql_error());

if(@mysql_num_rows($sql_busca_obrigacao_agenda) <= 0){	

$data_para_cadastrar = substr($obrigacao_data,6,4)."-".substr($obrigacao_data,3,2)."-".substr($obrigacao_data,0,2);	
$agendar = mysql_query("INSERT INTO pagina_agenda (agenda_evento, agenda_tipo, agenda_data, agenda_data_text) VALUES ('$obrigacao_nome', '$agenda_tipo', '$data_para_cadastrar', '$obrigacao_id')") or die(mysql_error());

		
}//fecha foreach($resultado_busca_obrigacao as $res_busca_obrigacao){
/////////////////// fecha cadastro de obrigação na agenda
}?>