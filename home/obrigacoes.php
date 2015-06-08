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
	}catch(PDOexception $error_honorarios){
		echo'Erro ao selecionar os honorários';}
		
	foreach($result_cliente as $res_cliente){
		$cliente_id = $res_cliente['cliente_id'];
		$cliente_nome = $res_cliente['cliente_nome'];
		$cliente_razao = $res_cliente['cliente_razao'];
		}
?>
  <tr>
    <td colspan="2"><strong>Cliente:</strong> <?php if($cliente_razao == ''){ echo $cliente_nome;} if($cliente_nome == ''){ echo $cliente_razao;}?></td>
    <td width="5%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="36%"><input type="button" name="voltar" value="voltar" class="btn" onClick="JavaScript: window.history.back();"/></td>
  </tr>
  
  
<?php
$status = 'sim';
$sql_ACO = 'SELECT * FROM atribuicao_cliente_obrigacao WHERE atribuicao_id_cliente = :id_cliente AND atribuicao_status = :status';

try{
	$query_ACO = $conecta->prepare($sql_ACO);
	$query_ACO->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_ACO->bindValue(':status',$status,PDO::PARAM_STR);
	$query_ACO->execute();
	$result_ACO = $query_ACO->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $error_ACO){
		echo'Erro ao selecionar os honorários';}
		
	foreach($result_ACO as $res_ACO){
		$atribuicao_id = $res_ACO['atribuicao_id'];
		$atribuicao_id_cliente = $res_ACO['atribuicao_id_cliente'];
		$atribuicao_id_obrigacao = $res_ACO['atribuicao_id_obrigacao'];
		$atribuicao_status = $res_ACO['atribuicao_status'];
		$atribuicao_nome_obrigacao = $res_ACO['atribuicao_nome_obrigacao'];
		

?>
<tr>
    <td width="6%">&nbsp;</td>
    <td colspan="2"><?php echo $atribuicao_nome_obrigacao;?></td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="36%">&nbsp;</td>
    
</tr>
<?php 
	}
?>
    
    
  
  
</table>

  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>