<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('Connections/config_pdo.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bruno Pippi - Assessoria Contábil</title>
<style type="text/css">
body{background:#f4f4f4;}
.ok{ font:18px "Trebuchet MS", Arial, Helvetica, sans-serif; color:#666; border:1px solid :#0F0; background:#DDFFDD; float:left; margin:5px; text-align:center;}
#info form{width:580px; height:135px;}
#info label{display:block; float:left; width:430px; margin:12px 0 0 80px;}
#info input{width:300px; float:left; color:#333;}
#info span{width:100px; float:left; display:block;}
#info .btn{width:80px; float:left; margin:33px 5px 0 178px; display:inline;}
#botoes .btn{width:80px; float:left; margin:0;}
#editar .btn{width:80px; float:left; margin:10px 3px 0 3px; }
#botes form{background:#FF0000; float:left;}
</style>
</head>
<script type="text/JavaScript">

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
$id_evento = $_GET['evento'];
?>
 <div id="info">

 	<form name="informacao" method="get" enctype="multipart/form-data">
         <label>
        	<span>Obrigação:</span>
            <input type="text" name="nome"  value="<?php echo $id_evento;?>"/>
        </label>
<?php

$select = 'SELECT * FROM pagina_agenda WHERE agenda_evento = :id_evento';
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
		$agenda_data = $res['agenda_data'];  
		

?>   
    	<label>
        	<span>Data:</span>
            <input type="text" name="data" value="<?php echo substr($agenda_data,8,2).'/'.substr($agenda_data,5,2).'/'.date('Y'); ?>" />
        </label>
 <?php } ?>     
        
        <input type="button" onclick="close_window()" value="Sair" class="btn">
    </form>
    <div id="botoes">
  
  <?php
		$registro = $_GET['evento'];
    if(isset($_POST['deletar'])){
$sql_deletar = 'DELETE FROM pagina_agenda WHERE agenda_id = :id_evento OR agenda_id = :registro ';
try{
	$query_deletar = $conecta->prepare($sql_deletar);
	$query_deletar->bindValue(':id_evento',$id_agenda,PDO::PARAM_STR);
	$query_deletar->bindValue(':registro',$registro,PDO::PARAM_STR);
	$query_deletar->execute();
	echo'<div class="ok">deletado com sucesso</div>';
	}catch(PDOexception $erro_del){
		$erro_del->getMessage();
 }
}
	?>   
 
    </div><!-- botoes -->
 </div><!-- info -->
</body>
</html>