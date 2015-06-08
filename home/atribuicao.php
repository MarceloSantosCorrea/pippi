<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início</div><!--caminho-->
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
        	<div id="atribuicao">
<?php
///////////////////////////////Seleção do cliente para aparecer o nome no inicio da página
$id_cliente = $_GET['cliente'];
$sql_select_listagem = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :id_cliente';
try{
	$query_select_cliente = $conecta->prepare($sql_select_listagem);
	$query_select_cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_select_cliente->execute();
	$resultado_clientes = $query_select_cliente->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select_cliente){
	echo'Erro ao selecionar clientes'.$error_select_cliente->getMessage();
	}
	
	foreach($resultado_clientes as $res_clientes){
		$id = $res_clientes['cliente_id'];
		$nome = $res_clientes['cliente_nome'];
		$razao = $res_clientes['cliente_razao'];

}?>
  <h3>Obrigações Acessórias para o cliente: <strong><?php if($razao == ''){ echo $nome;} if($nome == ''){ echo $razao;}?></strong>
  <a href="painel.php?exe=home/atribuicao_ok&amp;cliente=<?php echo $id_cliente ;?>&amp;all=ativar">Ativar Tudo</a>
  
  <a href="painel.php?exe=home/atribuicao_ok&amp;cliente=<?php echo $id_cliente ;?>&amp;all=desativar">Desativar Tudo</a>
  </h3>
  
<!-- fim da selecao do nome do cliente que aparece no inicio da pagina-->
<table width="100%" border="0"> 
 

<?php
/////////////tabela atribuicao_cliente_obrigacao é a tabela onde pega o id da obrigacao e o id do cliente
$sql_atri_obrig = 'SELECT * FROM atribuicao_cliente_obrigacao WHERE atribuicao_id_cliente = :id_cliente ORDER BY atribuicao_nome_obrigacao ';//buscando pelo id do cliente
try{
	$query_atri_obrig = $conecta->prepare($sql_atri_obrig);
	$query_atri_obrig->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
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
?>
  <tr>
    <td width="4%" height="30"><?php if($atribuicao_status == 'sim'){echo '<img src="images/ok.png">';} elseif($atribuicao_status == 'nao'){echo '<img src="images/no.png">';}?></td>
    <td width="46%"><?php echo $atribuicao_nome_obrigacao; ?></td>
    <td width="50%"><a href="painel.php?exe=home/atribuicao_ok&atribuicao=<?php echo $atribuicao_id;?>&amp;cliente=<?php echo $id_cliente ;?>" style="color:#069;"><?php if($atribuicao_status == 'sim'){echo 'Desativar';} elseif($atribuicao_status == 'nao'){echo 'Ativar';}?></a></td>
  </tr>
<?php
	}
?>
</table>


			</div><!-- atribuicao -->			
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>