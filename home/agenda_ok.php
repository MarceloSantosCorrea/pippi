
 <?php include_once('Connections/config_pdo.php');?>
 <?php
if(isset($_POST['cadastrar'])){
$data_agenda = trim("data2");
		 if(strstr($data_agenda, "/")){
			$dat = explode("/", $data_agenda); 
			$dat3 = $dat[2] . "-" . $dat[1] . "-" . $dat[0];
		 }	
$data_evento = $_POST['descricao'];
$data_horario = $_POST['horario'];
$insert_agenda = 'INSERT INTO pagina_agenda (agenda_data, agenda_evento, agenda_horario) ';
$insert_agenda .='VALUES (:agenda_data, :agenda_evento, agenda_horario)';

try{
	$query_agenda = $conecta->prepare($insert_agenda);
	$query_agenda->bindValue(':agenda_data',$dat3,PDO::PARAM_STR);
	$query_agenda->bindValue(':agenda_evento',$data_evento,PDO::PARAM_STR);
	$query_agenda->bindValue(':agenda_horario',$data_horario,PDO::PARAM_STR);
	$query_agenda->execute();
	echo'cadastro sucesso';
	}catch(PDOexception $error_insert_agenda){
		echo'Erro ao agendar Evento'.$error_insert_agenda->getMessage();
		}
}
?>
