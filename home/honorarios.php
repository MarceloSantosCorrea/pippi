<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Listagem de Clientes &raquo; Honorários Pagos</div><!--caminho-->
<?php
$logado = $_SESSION['MM_Username'];
$sql_select = 'SELECT * FROM login WHERE login_login = :logado';
try{
	$query_select = $conecta->prepare($sql_select);
	$query_select->bindValue(':logado',$logado,PDO::PARAM_STR);
	$query_select->execute();
	$result = $query_select->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select){
	echo'Erro ao selecionar';
	}
	foreach ($result as $res){
	 	$login_nome = $res['login_nome'];	
	}
?>
   <div class="welcome">Olá <?php echo $login_nome;?>| Hoje <?php echo date('d/m/Y');?> <span id="timer"></span> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
    
<?php include_once('menu.php');?>  
  
  <div id="conteudo">
  		<div id="conteudo_interno">
  		<table width="100%" class="listagem_clientes">
<?php
$id_cliente = $_GET['cliente'];
$sql_cliente = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :id_cliente';

try{
	$query_cliente = $conecta->prepare($sql_cliente);
	$query_cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_cliente->execute();
	$result_cliente = $query_cliente->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $error_cliente){
		echo'Erro o Cliente';}
		
	foreach($result_cliente as $res_cliente){
		$cliente_id = $res_cliente['cliente_id'];
		$cliente_nome = $res_cliente['cliente_nome'];
		$cliente_razao = $res_cliente['cliente_razao'];
		}
?>
<?php
$excluir = $_GET['excluir'];
$ExcluirPagamento = mysql_query ("DELETE FROM pagamento WHERE id = '$excluir'") or die (mysql_error());
?>
  <tr>
    <td colspan="2"><strong>Cliente:</strong> <?php if($cliente_razao == ''){ echo $cliente_nome;} if($cliente_nome == ''){ echo $cliente_razao;}?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="voltar" value="voltar" class="btn" onClick="JavaScript: window.history.back();"/></td>
  </tr>
  <form name="mes" action="" method="post" enctype="multipart/form-data" >
  
</table>
<table width="100%" border="0" class="honorarios">
 <tr bgcolor="#E1F5FF" style="font:14px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#069;">
    <td width="3%" align="center">&nbsp;</td>
    <td width="14%" align="center">Referência</td>
    <td width="19%" align="center">Data do Pagamento</td>
    <td width="3%" align="right">&nbsp;</td>
    <td width="10%" align="center">Valor</td>
    <td width="12%" align="center"  bgcolor="f4f4f4">&nbsp;</td>
    <td width="13%" align="center" bgcolor="f4f4f4">&nbsp;</td>
    <td width="26%" align="center" bgcolor="f4f4f4">&nbsp;</td>
</tr> 
<?php
$pag = "$_GET[pag]";
if($pag >= '1'){
 $pag = $pag;
}else{
 $pag = '1';
}

$maximo = '12'; //RESULTADOS POR PÁGINA
$inicio = ($pag * $maximo) - $maximo;
$sql_honorarios = 'SELECT * FROM pagamento WHERE id_cliente = :id_cliente ORDER BY data_pagamento LIMIT '.$inicio.','.$maximo.' ';
try{
	$query_honorarios = $conecta->prepare($sql_honorarios);
	$query_honorarios->bindValue(':id_cliente',$cliente_id,PDO::PARAM_STR);
	$query_honorarios->execute();
	$resultado_honorarios = $query_honorarios->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erro_honorario){
		echo $erro_honorario->getMessage();
		}
		foreach($resultado_honorarios as $res_honorarios){
			$idPagamento = $res_honorarios['id'];
			$mes_referente = $res_honorarios['referente_mes'];
			$ano_referente = $res_honorarios['referente_ano'];
			$data_pagamento = $res_honorarios['data_pagamento'];
			$valor = $res_honorarios['valor'];
switch($mes_referente) {
case"01": $mesNome = "Jan"; break;
case"02": $mesNome = "Fev"; break;
case"03": $mesNome = "Mar"; break;
case"04": $mesNome = "Abr"; break;
case"05": $mesNome = "Mai"; break;
case"06": $mesNome = "Jun"; break;
case"07": $mesNome = "Jul"; break;
case"08": $mesNome = "Ago"; break;
case"09": $mesNome = "Set"; break;
case"10": $mesNome = "Out"; break;
case"11": $mesNome = "Nov"; break;
case"12": $mesNome = "Dez"; break;

}			
?>

<tr bgcolor="#E1F5FF">
    <td width="3%" align="center"><img src="images/ok.png" /></td>
    <td width="14%" align="center"><?php echo $mesNome.'/'.$ano_referente;?></td>
    <td width="19%" align="center"><?php echo date('d/m/Y', strtotime($data_pagamento));?></td>
    <td width="3%" align="right">R$</td>
    <td width="10%" align="right"><?php echo number_format($valor, 2, ',', '.'); // retorna R$100.000,50 ?>&nbsp;&nbsp;</td>
    <td width="12%" align="center"><a href="javascript:abrir('info_alterar_pagamento.php?pagamento=<?php echo $idPagamento; ?>&amp;cliente=<?php echo $id_cliente;?>','400','200');">Alterar</a></td>
    <td width="13%" align="center"><a href="painel.php?exe=home/honorarios&cliente=<?php echo $id_cliente;?>&amp;excluir=<?php echo $idPagamento; ?>">Excluir</a></td>

    <td width="26%" align="center" bgcolor="f4f4f4">&nbsp;</td>
</tr>
 <?php
		}
		$sql_soma = mysql_query("SELECT SUM(valor) AS SOMA FROM pagamento WHERE id_cliente = '$cliente_id'");
 while($res_soma = mysql_fetch_array($sql_soma)){
			$mes_soma = $res_soma[0];}
 ?>
 <tr bgcolor="#E1F5FF">
    <td colspan="3">&nbsp;</td>
    <td width="3%" align="right">Total:</td>
    <td width="10%" align="right"><?php echo number_format($mes_soma, 2, ',', '.'); // retorna R$100.000,50 ?>&nbsp;&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#f4f4f4">&nbsp;</td>
</tr>
</table>
<?php

//USE A MESMA SQL QUE QUE USOU PARA RECUPERAR OS RESULTADOS
//SE TIVER A PROPRIEDADE WHERE USE A MESMA TAMBÉM
$sql_res = mysql_query("SELECT * FROM pagamento WHERE id_cliente = $id_cliente");
$total = mysql_num_rows($sql_res);

$paginas = ceil($total/$maximo);
$links = '5'; //QUANTIDADE DE LINKS NO PAGINATOR

echo "<a href=\"painel.php?exe=home/honorarios&amp;cliente=$id_cliente&amp;pag=1\">Primeira Página</a>&nbsp;";

for ($i = $pag-$links; $i <= $pag-1; $i++){
if ($i <= 0){
}else{
echo"<a href=\"painel.php?exe=home/honorarios&amp;cliente=$id_cliente&amp;pag=$i\">$i</a>&nbsp;";
}
}echo "$pag &nbsp;&nbsp;&nbsp;";

for($i = $pag +1; $i <= $pag+$links; $i++){
if($i > $paginas){
}else{
echo "<a href=\"painel.php?exe=home/honorarios&amp;cliente=$id_cliente&amp;pag=$i\">$i</a>&nbsp;";
}
}
echo "<a href=\"painel.php?exe=home/honorarios&amp;cliente=$id_cliente&amp;pag=$paginas\">Última página</a>&nbsp;";
?>

	</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>