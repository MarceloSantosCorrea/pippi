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
<link href="style/default.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0-min.js"></script>
<script type="text/javascript" src="Scripts/jquery.click-calendario-1.0.js"></script>		
<script type="text/javascript" src="Scripts/exemplo-calendario.js"></script>
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
$select = 'SELECT * FROM pagina_agenda WHERE agenda_id = :id_evento';
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
		$agenda_evento = $res['agenda_evento'];
		$agenda_horario = $res['agenda_horario'];
		$id = $res['agenda_id_cliente'];
			
		}

?>
 <div id="info">

 	<form name="informacao" method="post" enctype="multipart/form-data" action="editar_deletar_evento.php?id=<?php echo $id_evento;?>">
            
    	<label>
        	<span>Data:</span>
            <input type="text" name="data" id="data_1" value="<?php if(isset($agenda_data)){echo date('d/m/Y', strtotime($agenda_data));}?>" />
        </label>
        <label>	
                                        	<span>Horário</span>
                                            <select name="horario" id="horario">
                                            	<option value="<?php echo $agenda_horario;?>"><?php echo $agenda_horario;?></option>
                                                <option value="08:00hs">08:00hs</option>
                                                <option value="08:15hs">08:15hs</option>
                                                <option value="08:30hs">08:30hs</option>
                                                <option value="08:45hs">08:45hs</option>
                                                <option value="09:00hs">09:00hs</option>
                                                <option value="09:15hs">09:15hs</option>
                                                <option value="09:30hs">09:30hs</option>
                                                <option value="09:45hs">09:45hs</option>
                                                <option value="10:00hs">10:00hs</option>
                                                <option value="10:15hs">10:15hs</option>
                                                <option value="10:30hs">10:30hs</option>
                                                <option value="10:45hs">10:45hs</option>
                                                <option value="11:00hs">11:00hs</option>
                                                <option value="11:15hs">11:15hs</option>
                                                <option value="11:30hs">11:30hs</option>
                                                <option value="11:45hs">11:45hs</option>
                                                <option value="12:00hs">12:00hs</option>
                                                <option value="12:15hs">12:15hs</option>
                                                <option value="12:30hs">12:30hs</option>
                                                <option value="12:45hs">12:45hs</option>
                                                <option value="13:00hs">13:00hs</option>
                                                <option value="13:15hs">13:15hs</option>
                                                <option value="13:30hs">13:30hs</option>
                                                <option value="13:45hs">13:45hs</option>
                                                <option value="14:00hs">14:00hs</option>
                                                <option value="14:15hs">14:15hs</option>
                                                <option value="14:30hs">14:30hs</option>
                                                <option value="14:45hs">14:45hs</option>
                                                <option value="15:00hs">15:00hs</option>
                                                <option value="15:15hs">15:15hs</option>
                                                <option value="15:30hs">15:30hs</option>
                                                <option value="15:45hs">15:45hs</option>
                                                <option value="16:00hs">16:00hs</option>
                                                <option value="16:15hs">16:15hs</option>
                                                <option value="16:30hs">16:30hs</option>
                                                <option value="16:45hs">16:45hs</option>
                                                <option value="17:00hs">17:00hs</option>
                                                <option value="17:15hs">17:15hs</option>
                                                <option value="17:30hs">17:30hs</option>
                                                <option value="17:45hs">17:45hs</option>
                                                <option value="18:00hs">18:00hs</option>
                                                <option value="18:15hs">18:15hs</option>
                                                <option value="18:30hs">18:30hs</option>
                                                <option value="18:45hs">18:45hs</option>
                                                <option value="19:00hs">19:00hs</option>
                                                </select>
                                        </label>
                <label>
        	<span>Descrição:</span>
            <textarea name="descricao"  rows="4" cols="35"><?php echo $agenda_evento;?></textarea>
        </label>
        <input type="button" onclick="close_window()" value="Sair"  style="margin:20px 2px 0 180px; float:left; width:100px;">
        <input type="submit" name="deletar" value="Deletar"  style="margin:20px 2px; float:left; width:100px; " />
        <input type="submit" name="salvar" value="Salvar"  style="margin:20px 2px; float:left; width:100px; " />
    </form>

 </div><!-- info -->
</body>
</html>