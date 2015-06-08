<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Listagem de Usuários</div><!--caminho-->
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
       	  <div class="lista">
        	<form name="localizar_cadastro" action="" method="post" enctype="multipart/form-data">
            	<label>
                	<span>Localizar Cadastro</span>
                    <input type="text" name="busca" />
                    <input type="submit" name="buscar" value="Listar" class="btn" />
                </label>
                
                
            </form>
  			</div><!--listagem de cliente-->
<?php
if(isset($_POST['buscar'])){
$busca = $_POST['busca'];

$sql_select_listagem = 'SELECT * FROM login WHERE login_nome  LIKE :busca  AND login_login !="marcelo"   ORDER BY login_nome ASC';

try{
	$query_select_usuario = $conecta->prepare($sql_select_listagem);
	$query_select_usuario->bindValue(':busca','%'.$busca.'%',PDO::PARAM_STR);
	$query_select_usuario->execute();
	$resultado_usuario = $query_select_usuario->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select_cliente){
	echo'Erro ao selecionar clientes'.$error_select_cliente->getMessage();
	}
	
	foreach($resultado_usuario as $res_usuarios){
		$id = $res_usuarios['login_id'];
		$nome = $res_usuarios['login_nome'];
		$nivel = $res_usuarios['login_nivel'];
		
?>		       	
        	<table width="100%" border="0" class="listagem_clientes">
  <tr bgcolor="#E1F5FF">
    <td width="40%">&nbsp;&nbsp;<?php echo $nome;?></td>
    <td width="13%" align="center"><a href="painel.php?exe=home/listar_usuario_editar_cadastro&amp;usuario=<?php echo $id;?>">Cadastro</a></td>
    <td width="13%" align="center"><a href="painel.php?exe=home/excluir_usuario&amp;usuario=<?php echo $id;?>">Excluir</a></td>

  </tr>
</table>
<?php 
}}
?> 
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>