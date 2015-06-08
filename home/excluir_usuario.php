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
		$login_id = $res['login_id'];
	 	$login_nome = $res['login_nome'];	
	}
?>
   <div class="welcome">Olá <?php echo $login_nome;?>| Hoje <?php echo date('d/m/Y');?> <span id="timer"></span> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
    
<?php include_once('menu.php');?>  
  
  <div id="conteudo">
  		<div id="conteudo_interno">
  <input type="button" name="voltar" value="Voltar" onclick="JavaScript: window.history.back();"  class="btn"/ >		
<?php
$id_usuario = $_GET['usuario'];
if($id_usuario == $login_id){
	echo'<script type="text/javascript">
	alert("Você não pode deletar este Usuário, porque está logado no momento.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_usuarios"';
	}else{
$sql_cliente = 'DELETE FROM login WHERE login_id = :id_usuario';

try{
	$query_cliente = $conecta->prepare($sql_cliente);
	$query_cliente->bindValue(':id_usuario',$id_usuario,PDO::PARAM_STR);
	$query_cliente->execute();		
	}catch(PDOexception $error_deletar_cadastro){
		echo'Erro ao deletar o cadastro';}

$DeletarTecnico = mysql_query ("DELETE FROM cadastro_tecnico WHERE usuario_id = '$id_usuario'") or die (mysql_error());

if($sql_cliente >= '1'){
	echo'<script type="text/javascript">
	alert("Deletado com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_usuarios"';
	}
		
}
	
?>


  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>