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
  <?php 
	  
$sqlContarNivel = 'SELECT * FROM login';
try{
	$queryContarNivel = $conecta->prepare($sqlContarNivel);
	$queryContarNivel->execute();
	$countContarNivel = $queryContarNivel->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $erroContarNivel){
		echo'Erro ao selecionar os niveis de usuarios'.$erroContarNivel->getMessage();
		}
if($countContarNivel <= 2){
		  echo'<div class="alert">Você náo pode trocar o nível deste usuário, porque este é o último usuario Administrador.</div>';}
if(isset($_POST['editar_usuario'])){	  
$id_usuario = $_POST['usuario_id'];
$usuario_nome =  $_POST['usuario_nome'];
$usuario_email =  $_POST['usuario_email'];
$usuario_fone_resid =  $_POST['usuario_fone_resid'];
$usuario_fone_cel =  $_POST['usuario_fone_cel'];
$usuario_nivel = $_POST['usuario_nivel'];
$tecnicoRegistro = $_POST['registro_tecnico'];
$tecnicoOrgao = $_POST['orgao_tecnico'];
$tecnicoUf = $_POST['uf_tecnico'];
$tecnicoFone = $_POST['fone_tecnico'];

$sql_editar_usuario = 'UPDATE login SET login_nome = :usuario_nome, 
									        login_email = :usuario_email,
									   login_fone_resid = :usuario_fone_resid,
									     login_fone_cel = :usuario_fone_cel,
										    login_nivel = :login_nivel
									     WHERE login_id = :id_usuario';
try{
	$query_editar_usuario = $conecta->prepare($sql_editar_usuario);
	$query_editar_usuario->bindValue(':id_usuario',$id_usuario,PDO::PARAM_STR);
	$query_editar_usuario->bindValue(':usuario_nome',$usuario_nome,PDO::PARAM_STR);
	$query_editar_usuario->bindValue(':usuario_email',$usuario_email,PDO::PARAM_STR);
	$query_editar_usuario->bindValue(':usuario_fone_resid',$usuario_fone_resid,PDO::PARAM_STR);
	$query_editar_usuario->bindValue(':usuario_fone_cel',$usuario_fone_cel,PDO::PARAM_STR);
	$query_editar_usuario->bindValue(':login_nivel',$usuario_nivel,PDO::PARAM_STR);
	$query_editar_usuario->execute();
	
}catch(PDOexception $error_editar_usuario){
	echo'Erro ao selecionar clientes'.$error_editar_usuario->getMessage();
	}
	
$SelectCadastroTecnico = mysql_query ("SELECT * FROM cadastro_tecnico WHERE usuario_id = '$id_usuario'") or die (mysql_error());
if(@mysql_num_rows($SelectCadastroTecnico)>= '1'){

$EditarCadastroTecnico = mysql_query ("UPDATE cadastro_tecnico SET tecnico_nome = '$usuario_nome',
																	tecnico_registro = '$tecnicoRegistro',
																	tecnico_orgao = '$tecnicoOrgao',
																	tecnico_uf = '$tecnicoUf',
																	tecnico_fone = '$tecnicoFone'
																	WHERE usuario_id = '$id_usuario'") or die (mysql_error());
}else{
$CadastrarTecnico = mysql_query ("INSERT INTO cadastro_tecnico (tecnico_nome, tecnico_registro, tecnico_orgao, tecnico_uf, tecnico_fone, usuario_id) 
                                       VALUES ('$usuario_nome','$tecnicoRegistro','$tecnicoOrgao','$tecnicoUf','$tecnicoFone', '$id_usuario')") or die (mysql_error());	
}
	
if($sql_editar_usuario >= '1'){
	echo'<script type="text/javascript">
	alert("Salvo com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_usuario_editar_cadastro&usuario='.$id_usuario.'"';
	}
	
}?>
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>