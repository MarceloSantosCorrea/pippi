<?php
$SelecionaCadastroObrigacoes = mysql_query("SELECT * FROM cadastro_obrigacao") or die (mysql_error());
while($resSelecionaCadastroObrigacoes = mysql_fetch_array($SelecionaCadastroObrigacoes)){
   	  $selecionaObrigacaoId = $resSelecionaCadastroObrigacoes['obrigacao_id'];
	$selecioneObrigacaoNome = $resSelecionaCadastroObrigacoes['obrigacao_nome'];
	$selecionaObrigacaoData = $resSelecionaCadastroObrigacoes['obrigacao_data'];
   	 $selecionaObrigacaoMd5 = $resSelecionaCadastroObrigacoes['obrigacao_md5'];

$SelecionaDataVencimentoObrigacao = mysql_query ("SELECT * FROM data_vencimento_obrigacao WHERE obrig_data_id_cadastro = '$selecionaObrigacaoId';") or die (mysql_error());
if(@mysql_num_rows($SelecionaDataVencimentoObrigacao) <= 0){
	
$UpdateDataVencimentoPorCadastroObrigacao = mysql_query("INSERT INTO data_vencimento_obrigacao 
															(obrig_data_vencimento, obrig_data_id_obrigacao, obrig_data_id_cadastro, obrig_data_nome_cadastro) 
													 VALUES ('$selecionaObrigacaoData','$selecionaObrigacaoMd5','$selecionaObrigacaoId','$selecioneObrigacaoNome')") 
														or die(mysql_error());
	}	
	}
?>