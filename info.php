<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('Connections/config_pdo.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bruno Pippi - Assessoria Contábil</title>
<style type="text/css">
body{background:#f4f4f4;}
#info form{width:580px; height:135px;}
#info label{display:block; float:left; width:430px; margin:12px 0 0 80px;}
#info input{width:300px; float:left; color:#333;}
#info span{width:100px; float:left; display:block;}
#info .btn{width:80px; float:left; margin:10px 5px 0 178px; display:inline;}
#botoes .btn{width:80px; float:left; margin:10px 5px 0 5px;}
#editar .btn{width:80px; float:left; margin:10px 3px 0 3px;}
#botes form{background:#FF0000; float:left;}
</style>
</head>
<script language="JavaScript" type="text/JavaScript">

function Refresh() {
window.opener.location.href = "painel.php?exe=home/admin";

}
function close_window() {
Refresh();
window.close();
}

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
		$id_agenda = $res['agenda_id'];
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
            <input type="text" name="nome" value="<?php echo $nome;?>" />
        </label>
        <label>
        	<span>Telefone:</span>
            <input type="text" name="nome"  value="<?php echo $telefone;?>" />
        </label>
        <label>
        	<span>Celular:</span>
            <input type="text" name="nome"  value="<?php echo $celular;?>"/>
        </label>
        <label>
        	<span>Endereço:</span>
            <input type="text" name="nome"  value="<?php echo $endereco;?>"/>
        </label>
        <label>
        	<span>N°:</span>
            <input type="text" name="nome"  value="<?php echo $num_endereco;?>"/>
        </label>
        <label>
        	<span>Bairro:</span>
            <input type="text" name="nome"  value="<?php echo $bairro;?>"/>
        </label>
        <label>
        	<span>Email:</span>
            <input type="text" name="nome"  value="<?php echo $email;?>"/>
        </label>
        <input type="button" onclick="close_window()" value="Sair" class="btn">
    </form>
    <div id="botoes">
    <form name="deletar" action="" method="post" enctype="multipart/form-data">
        <?php
		$registro = $_GET['evento'];
    if(isset($_POST['deletar'])){
$sql_deletar = 'DELETE FROM pagina_agenda WHERE agenda_id = :id_evento OR agenda_id = :registro ';
try{
	$query_deletar = $conecta->prepare($sql_deletar);
	$query_deletar->bindValue(':id_evento',$id_agenda,PDO::PARAM_STR);
	$query_deletar->bindValue(':registro',$registro,PDO::PARAM_STR);
	$query_deletar->execute();
	echo'deletado com sucesso';
	}catch(PDOexception $erro_del){
		$erro_del->getMessage();
 }
}
	?>
		<input type="submit" name="deletar" value="Deletar" onclick="" class="btn" />    
    </form>
    
 <div id="editar">   
    
    </div>
    </div><!-- botoes -->
 </div><!-- info -->
</body>
</html>