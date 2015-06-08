<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('Connections/config_pdo.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bruno Pippi - Assessoria Contábil</title>
<style type="text/css">
body{background:#f4f4f4;}
#info form{width:580px; height:380px;}
#info label{display:block; float:left; width:430px; margin:12px 0 0 80px;}
#info input{width:300px; float:left; color:#333;}
#info span{width:100px; float:left; display:block;}
#info a{width:80px; float:right; margin:15px 95px; border:1px solid #069; color:#666; padding:2px; text-decoration:none; text-align:center; }
</style>
</head>
<script language="Javascript" type="text/Javascript">
<!--
function close_window() {
    window.close();
}
//-->
</script>

<body>
<?php
$id_evento = $_GET['id'];
$select = 'SELECT * FROM pagina_agenda WHERE agenda_id_cliente = :id_evento';
try{
	$query = $conecta->prepare($select);
	$query->bindValue(':id_evento',$id_evento,PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexceoption $erro_select){
		echo'Erro Ao selecionar'.$erro_select->getMessage();
		}
		foreach($result as $res){
		$id = $res['agenda_id_cliente'];
			
		}
$sql_cliente = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :id';
try{
	$query_cliente = $conecta->prepare($sql_cliente);
	$query_cliente->bindValue(':id',$id,PDO::PARAM_STR);
	$query_cliente->execute();
	$result_cliente = $query_cliente->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexceprion $erro_cliente){
		echo'Erro ao selecionar cliente'.$erro_cliente->getMessage();
		}
		foreach($result_cliente as $res_cliente){
		$nome = $res_cliente['cliente_nome'];
		$telefone = $res_cliente['cliente_fone_resid'];
		$celular = $res_cliente['cliente_fone_cel'];
		$endereco = $res_cliente['cliente_endereco'];
		$num_endereco = $res_cliente['cliente_num_endereco'];
		$bairro = $res_cliente['cliente_bairro'];
		$email = $res_cliente['cliente_email'];
			}
?>
 <div id="info">
 	<form name="informacao" method="get" enctype="multipart/form-data">
    	<label>
        	<span>Nome:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $nome;?>" />
        </label>
        <label>
        	<span>Telefone:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $telefone;?>" />
        </label>
        <label>
        	<span>Celular:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $celular;?>"/>
        </label>
        <label>
        	<span>Endereço:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $endereco;?>"/>
        </label>
        <label>
        	<span>N°:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $num_endereco;?>"/>
        </label>
        <label>
        	<span>Bairro:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $bairro;?>"/>
        </label>
        <label>
        	<span>Email:</span>
            <input type="text" name="nome" disabled="disabled" value="<?php echo $email;?>"/>
        </label>
        <a href="javascript:;" onclick="close_window()">Sair</a>
    </form>
 </div><!-- info -->
</body>
</html>