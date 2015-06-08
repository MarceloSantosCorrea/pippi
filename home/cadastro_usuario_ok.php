<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início &raquo; Confirmação de Cadastro</div><!--caminho-->
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
<?php if(isset($_POST['usuario_cadastrar'])){
$usuario_nome = strip_tags(trim($_POST['usuario_nome']));
$usuario_email = strip_tags(trim($_POST['usuario_email']));
$usuario_fone_resid = strip_tags(trim($_POST['usuario_fone_resid']));
$usuario_fone_cel = strip_tags(trim($_POST['usuario_fone_cel']));
$usuario_login = strip_tags(trim($_POST['usuario_login']));
$usuario_senha = strip_tags(trim($_POST['usuario_senha']));
$usuario_nivel = strip_tags(trim($_POST['usuario_nivel']));
$tecnico_registro = strip_tags(trim($_POST['registro']));
$tecnico_orgao = strip_tags(trim($_POST['orgao']));
$tecnico_uf = strip_tags(trim($_POST['uf']));
$tecnico_fone = strip_tags(trim($_POST['foneTecnico']));
$usuario_data_cadastro = date('Y-m-d H:i:s');
$usuario_data_modificado = date('Y-m-d H:i:s');
$_SESSION['usuario_nome'] = $usuario_nome;
$_SESSION['usuario_email'] = $usuario_email;
$_SESSION['usuario_fone_resid'] = $usuario_fone_resid;
$_SESSION['usuario_fone_cel'] = $usuario_fone_cel;
$_SESSION['usuario_login'] = $usuario_login;
$_SESSION['usuario_senha'] = $usuario_senha;
$_SESSION['usuario_nivel'] = $usuario_nivel;
if($usuario_nome == ''){
	echo'<script type="text/javascript">
	alert("Informe o Nome do Usuário.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_usuarios"';
	}elseif($usuario_login == ''){
	echo'<script type="text/javascript">
	alert("Informe o Login do Usuário.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_usuarios">';
	}elseif($usuario_senha == ''){
	echo'<script type="text/javascript">
	alert("Informe a Senha do Usuário.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_usuarios">';
	}elseif($usuario_nivel == ''){
	echo'<script type="text/javascript">
	alert("Informe o Nível do Usuário.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_usuarios">';
	}else{
$sqlUsuarioDuplicado = mysql_query("SELECT * FROM login WHERE login_nome = '$usuario_nome'");
	
if(@mysql_num_rows($sqlUsuarioDuplicado) >= 1){
	echo'<script type="text/javascript">
	alert("Usuário já Cadastrado.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_usuarios">';
	}else{

$sql_cadastra_usuario = mysql_query("INSERT INTO login
(login_nome, login_email, login_login, login_fone_resid, login_fone_cel, login_senha, login_nivel, login_data_cadastro,
login_data_modificado) VALUES ('$usuario_nome', '$usuario_email', '$usuario_login', '$usuario_fone_resid', '$usuario_fone_cel',
'$usuario_senha', '$usuario_nivel', '$usuario_data_cadastro', '$usuario_data_modificado')"); 
	
$sqlUsuarioId = mysql_query("SELECT * FROM login WHERE login_nome = '$usuario_nome'");
while($resUsuarioDuplicado = mysql_fetch_array($sqlUsuarioId)){
		$usuarioId = $resUsuarioDuplicado['login_id'];
		}	
	
$sqlCadatroTecnico = mysql_query("INSERT INTO cadastro_tecnico (tecnico_nome, tecnico_registro, tecnico_orgao, tecnico_uf,
tecnico_fone, usuario_id) VALUES ('$usuario_nome', '$tecnico_registro', '$tecnico_orgao', '$tecnico_uf', '$tecnico_fone',
'$usuarioId')")or die (mysql_error());
	unset($_SESSION['usuario_nome']);
	unset($_SESSION['usuario_email']);
    unset($_SESSION['usuario_fone_resid']);
	unset($_SESSION['usuario_fone_cel']);
	unset($_SESSION['usuario_login']);
	unset($_SESSION['usuario_senha']);
	unset($_SESSION['usuario_nivel']);
	echo'<script type="text/javascript">
	alert("Cadastrado com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_usuarios">';	
	
	}}

}?>
        
  		
        </div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>