<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nova data da Obrigação</title>
</head>
<?php include_once('conexao.php');?>
<link href="style/default.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0-min.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0.js"></script>		
<script type="text/javascript" src="Scripts/exemplo-calendario.js"></script>
<style type="text/css">
*{margin:0; padding:0;}
form{ width:300px; height:200px; float:left; margin:0; padding:0;}
label{width:210px; float:left; margin:20px 50px;} 
span{font:14px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#069;}
input{padding:3px; color:#666;} 
</style>


<body>
<?php
$data = $_GET['data'];
$md5 = $_GET['nome'];
$idVencimento = $_GET['id_vencimento'];
$idCadastro = $_GET['id_cadastro'];
if(isset($_POST['alterar'])){
$data_vencimento = $_POST['nova_data'];
$data_nova = substr($data_vencimento,0,2).'/'.substr($data_vencimento,3,2).'/0000';
$dataAgenda = '0000'.'-'.substr($data_vencimento,3,2).'-'.substr($data_vencimento,0,2);
$sqlAlterarCadastroObrigacao = mysql_query("UPDATE cadastro_obrigacao SET obrigacao_data = '$data_nova' WHERE obrigacao_id = '$idCadastro'") or die (mysql_error());	

$sqlAlterarDataVencimentoObrigacao = mysql_query ("UPDATE data_vencimento_obrigacao SET obrig_data_vencimento = '$data_nova' WHERE obrig_data_id = '$idVencimento';") or die (mysql_error());	

$sqlAlterarDataAgenda = mysql_query("UPDATE pagina_agenda SET agenda_data = '$dataAgenda' WHERE agenda_data_text = '$idCadastro'") or die(mysql_error());
		
	echo'
	<script type="text/JavaScript">
    function Refresh() {
    window.opener.location.href = "painel.php?exe=home/controle_datas_obrigacoes&obrigacao='.$md5.'";}
    function close_window() {
    Refresh();
    window.close();}
    </script>
	<script type="text/javascript">
	alert("Data alterada com sucesso.");
	close_window();
	</script>	
	';	
}
?>
<form name="alterar_data" action="" method="post" enctype="multipart/form-data">
	<label>
    	<span>Informe a Nova Data:</span>
        <input type="text" name="nova_data" id="data_1" value="<?php echo $dat = substr($data,0,2).'/'.substr($data,3,2).'/'.date('Y');?>"  />
        <input type="submit" name="alterar" value="Alterar" class="btn" />
    </label>
</form>
</body>
</html>