<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nova data da Obrigação</title>
</head>
<?php include_once('conexao.php');?>
<link href="style/default.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
*{margin:0; padding:0;}
form{ width:360px; height:100px; float:left; margin:0; padding:0; }
label{width:360px; float:left; margin:20px 0 0 50px;} 
span{font:14px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#069; float:left;}
input{padding:4px; width:250px; color:#666; float:left;} 
.btn{width:80px; float:left; margin:0 0 0 5px;}
</style>


<body>
<?php
$obrigacao = $_GET['obrigacao'];
$md5 = $_GET['cod'];
if(isset($_POST['alterar'])){
$NovoNome = $_POST['novo_nome'];
$NovoNomeMd5 = md5($NovoNome);
$sqlAlterarCadastroObrigacao = mysql_query("UPDATE cadastro_obrigacao SET obrigacao_nome = '$NovoNome',
																		   obrigacao_md5 = '$NovoNomeMd5'
																    WHERE obrigacao_nome = '$obrigacao'") or die (mysql_error("cadastro Obrigacao"));	

$sqlAlterarDataVencimentoObrigacao = mysql_query ("UPDATE data_vencimento_obrigacao SET obrig_data_id_obrigacao = '$NovoNomeMd5',
																				       obrig_data_nome_cadastro = '$NovoNome'
                                                                                 WHERE obrig_data_nome_cadastro = '$obrigacao'") or die (mysql_error("Datas vencimento"));	

$sqlAlterarDataAgenda = mysql_query("UPDATE pagina_agenda SET agenda_evento = '$NovoNome' WHERE agenda_evento = '$obrigacao'") or die(mysql_error("agenda"));
		
	echo'
	<script type="text/JavaScript">
    function Refresh() {
    window.opener.location.href = "painel.php?exe=home/controle_datas_obrigacoes&obrigacao='.$NovoNomeMd5.'";}
    function close_window() {
    Refresh();
    window.close();}
    </script>
	<script type="text/javascript">
	close_window();
	</script>	
	';	
}
?>
<form name="alterar_data" action="" method="post" enctype="multipart/form-data">
	<label>
    	<span>Informe a Novo Nome:</span>
        <input type="text" name="novo_nome" id="novo_nome" value="<?php echo $obrigacao;?>"  />
        <input type="submit" name="alterar" value="Alterar" class="btn" />
    </label>
</form>
</body>
</html>