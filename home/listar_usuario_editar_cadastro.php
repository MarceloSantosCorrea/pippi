<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>

<script type="text/javascript">
	$(function(){
		$("#tecnico").click(function(){
			$("#dados_tecnico").show("slow");
		});
		$("#admin").click(function(){
			$("#dados_tecnico").hide("slow");
		});
		$("#usuario").click(function(){
			$("#dados_tecnico").hide("slow");
		});
		$("#-1").click(function(){
			$("#dados_tecnico").hide("slow");
		});
	});

</script>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Cadastros de Usuários</div><!--caminho-->
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
        	<div id="visualizar_cadastro_usuario">
            	
<?php
$sqlContarNivel = 'SELECT * FROM login WHERE login_nivel = :login_nivel';
try{
	$queryContarNivel = $conecta->prepare($sqlContarNivel);
	$queryContarNivel->bindValue(':login_nivel','admin',PDO::PARAM_STR);
	$queryContarNivel->execute();
	$countContarNivel = $queryContarNivel->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $erroContarNivel){
		echo'Erro ao selecionar os niveis de usuarios'.$erroContarNivel->getMessage();
		}
if($countContarNivel <= 2){
		  echo'<div class="alert">Você náo pode trocar o nível deste usuário, porque este é o último usuario Administrador.</div>';}


$id_usuario = $_GET['usuario'];
$sql_usuario = 'SELECT * FROM login WHERE login_id = :id_usuario';
try{
	$query_select_usuario = $conecta->prepare($sql_usuario);
	$query_select_usuario->bindValue(':id_usuario',$id_usuario,PDO::PARAM_STR);
	$query_select_usuario->execute();
	$resultado_usuario = $query_select_usuario->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOexception $error_select_usuario){
	echo'Erro ao selecionar clientes'.$error_select_usuario->getMessage();
	}
	
	foreach($resultado_usuario as $res_usuario){
		$usuario_id = $res_usuario['login_id'];
		$usuario_nome = $res_usuario['login_nome'];
		$usuario_email = $res_usuario['login_email'];
		$usuario_fone_resid = $res_usuario['login_fone_resid'];
		$usuario_fone_cel = $res_usuario['login_fone_cel'];
		$usuario_data_cadastro = $res_usuario['login_data_cadastro'];
		$usuario_nivel = $res_usuario['login_nivel'];
}
$SelectDadosTecnico = mysql_query ("SELECT * FROM cadastro_tecnico WHERE usuario_id = '$id_usuario'") or die (mysql_error());
while($resDadosTecnico = mysql_fetch_array($SelectDadosTecnico)){
		$tecnicoRegistro = $resDadosTecnico['tecnico_registro'];
		$tecnicoOrgao = $resDadosTecnico['tecnico_orgao'];
		$tecnicoUf = $resDadosTecnico['tecnico_uf'];
		$tecnicoFone = $resDadosTecnico['tecnico_fone'];	
}
?>
<form name="editar_usuarios_ok" action="painel.php?exe=home/editar_usuarios_ok" method="post">
  	<input type="hidden" name="usuario_id" value="<?php echo $usuario_id;?>" />
    <label>
    	<span>Nome:</span>
    		<input type="text" name="usuario_nome" id="usuario_nome"  value="<?php echo  $usuario_nome; ?>" disabled="disabled">
    </label>
    <label>
  		<span>E-mail:</span>
    		<input type="text" name="usuario_email" id="usuario_email" value="<?php echo  $usuario_email; ?>"disabled="disabled">
    </label>
    <label>
		<span>Telefone:</span>
   			<input type="text" name="usuario_fone_resid" id="usuario_fone_resid" value="<?php echo  $usuario_fone_resid; ?>"disabled="disabled">
    </label>
    <label>
		<span>Celular:</span>
   			<input type="text" name="usuario_fone_cel" id="usuario_fone_cel" value="<?php echo  $usuario_fone_cel; ?>"disabled="disabled">
	</label>
    <label>
		<span>Nível:</span>   
   			<select name="usuario_nivel" id="usuario_nivel" disabled="disabled">
<?php 
if($usuario_nivel == 'admin'){
?>    
    			<option value="admin" id="admin">Administrador</option>
    			<option value="usuario" id="usuario">Usuário</option>
    			<option value="tecnico" id="tecnico">Técnico</option>
<?php
}if($usuario_nivel == 'usuario'){
?>    
    			<option value="usuario" id="usuario">Usuário</option>
   				<option value="admin" id="admin">Administrador</option>
   				<option value="tecnico" id="tecnico">Técnico</option>
<?php
}if($usuario_nivel == 'tecnico'){
?>    
    			<option value="tecnico" id="tecnico">Técnico</option>
   				<option value="admin" id="admin">Administrador</option>
    			<option value="usuario" id="usuario">Usuário</option>
<?php
}
?>
</select> 
   </label>
<?php
if($usuario_nivel == 'tecnico'){
?>    
       

   <div id="dados_tecnico" style=" <?php if($usuario_nivel != 'tecnico'){?>display:none;<?php }?> float:left;">
    <label>
    	<span>Registro:</span>
        	<input type="text" name="registro_tecnico" id="registro_tecnico" value="<?php echo $tecnicoRegistro;?>" disabled="disabled" />
    </label>
    <label>
    	<span>orgão:</span>
        	<input type="text" name="orgao_tecnico" id="orgao_tecnico" value="<?php echo $tecnicoOrgao;?>" disabled="disabled"/>
    </label>
    <label>
    	<span>UF:</span>
        	<input type="text" name="uf_tecnico" id="uf_tecnico"  value="<?php echo $tecnicoUf;?>" disabled="disabled" />
    </label>
    <label>
    	<span>Telefone (FID):</span>
        	<input type="text" name="fone_tecnico" id="fone_tecnico"  value="<?php echo $tecnicoFone;?>" disabled="disabled" />
    </label>
    </div><!-- info_tecnico -->
<?php
}if($usuario_nivel != 'tecnico'){
?>    
       

   <div id="dados_tecnico" style=" <?php if($usuario_nivel != 'tecnico'){?>display:none;<?php }?> float:left;">
    <label>
    	<span>Registro:</span>
        	<input type="text" name="registro_tecnico" id="registro_tecnico" value="<?php echo $tecnicoRegistro;?>" disabled="disabled" />
    </label>
    <label>
    	<span>orgão:</span>
        	<input type="text" name="orgao_tecnico" id="orgao_tecnico" value="<?php echo $tecnicoOrgao;?>" disabled="disabled"/>
    </label>
    <label>
    	<span>UF:</span>
        	<input type="text" name="uf_tecnico" id="uf_tecnico"  value="<?php echo $tecnicoUf;?>" disabled="disabled" />
    </label>
    <label>
    	<span>Telefone (FID):</span>
        	<input type="text" name="fone_tecnico" id="fone_tecnico"  value="<?php echo $tecnicoFone;?>" disabled="disabled" />
    </label>
    </div><!-- info_tecnico -->
<?php
}
?>
    <label>
 		<span>Data Cadastro:</span>
    		<input type="text" name="usuario_data_cadastro" id="usuario_data_cadastro" disabled="disabled" value="<?php echo date('d/m/Y H:i', strtotime($usuario_data_cadastro));?>"> 
    </label> 
    <label>
   			 <input type="button" name="editar" id="editar" value="Editar" class="btn"/>
             <input type="submit" name="editar_usuario" value="Salvar" class="btn" />
     </label>
 </form>

			  
       	  </div><!-- visualizar cadastro usuario-->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>