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
        	<div id="visualizar_cadastro">
<form name="cadastro_de_usuarios" action="painel.php?exe=home/cadastro_usuario_ok" method="post">
	<label>
    <span>Nome:</span>
    <input type="text" name="usuario_nome" value="<?php echo $_SESSION['usuario_nome'];?>">
    </label>
    <label>
    <span>E-mail:</span>
    <input type="text" name="usuario_email" value="<?php echo $_SESSION['usuario_email'];?>">
    </label>
    <label><span>Telefone:</span>
    <input type="text" name="usuario_fone_resid" onkeypress="mascaraData(this);" maxlength="14" value="<?php echo $_SESSION['usuario_fone_resid'];?>">
    </label>
    <label>
    <span>Celular:</span>
    <input type="text" name="usuario_fone_cel" onkeypress="mascaraCelular(this);" maxlength="14" value="<?php echo $_SESSION['usuario_fone_cel'];?>">
    </label>
    <label>
    <span>Login:</span>
    <input type="text" name="usuario_login" value="<?php echo $_SESSION['usuario_login'];?>">
    </label>
    <label>
    <span>Senha:</span>
    <input type="password" name="usuario_senha" value="<?php echo $_SESSION['usuario_senha'];?>">
    </label>
<div class="tecnico">
    <label>
    <span>Nível:</span>
    <select name="usuario_nivel">
    <option value="-1" id="-1">Selecione o Nível</option>
    <option value="admin" id="admin">Administrador</option>
    <option value="usuario" id="usuario">Usuário</option>
    <option value="tecnico" id="tecnico">Administrador/Técnico</option>
    </select>
    </label>
</div><!-- tecnico -->    
    <div id="dados_tecnico" style="display:none; float:left;">
    <label>
    	<span>Registro:</span>
        <input type="text" name="registro" id="registro" />
    </label>
    <label>
    	<span>orgão:</span>
        <input type="text" name="orgao" id="orgao" />
    </label>
    <label>
    	<span>UF:</span>
        <input type="text" name="uf" id="uf" />
    </label>
    <label>
    	<span>Fone (FID):</span>
        <input type="text" name="foneTecnico" id="foneTecnico" />
    </label>
    </div><!-- dados_tecnico -->
    <input type="submit" name="usuario_cadastrar" value="Cadastrar" class="btn" />
  
  
    </form>

          	</div><!-- visualizar cadastro -->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>