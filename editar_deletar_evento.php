<?php include_once('conexao.php');?>
<script type="text/JavaScript">

function Refresh() {
window.opener.location.href = "painel.php?exe=home/admin";

}
function close_window() {
Refresh();
window.close();
}

</script>
  <?php
$id_evento = $_GET['id']; 
function get_post_action($name)
{
    $params = func_get_args();
    
    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}
switch (get_post_action('salvar', 'deletar')) {
    case 'salvar':
$data = $_POST['data'];
$dataTimestamp = substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2);
$horario = $_POST['horario'];
$descricao = $_POST['descricao'];
$SalvarEvento = mysql_query("UPDATE pagina_agenda SET agenda_data = '$dataTimestamp', 
												    agenda_evento = '$descricao',
												   agenda_horario = '$horario'	
											  	  WHERE agenda_id = '$id_evento'") or die (mysql_error());
if($SalvarEvento == 1){
	echo'<script type="text/javascript">
	alert("Alterado com sucesso.");
	</script>
	<script type="text/javascript">
	close_window();
	</script>';
	}     

 break;
    
    case 'deletar':
          
$DeletarEvento = mysql_query("DELETE FROM pagina_agenda WHERE agenda_id = '$id_evento'")or die (mysql_error());
if($DeletarEvento == 1){
	echo'<script type="text/javascript">
	alert("deletado com sucesso.");
	</script>
	<script type="text/javascript">
	close_window();
	</script>';}

}
	?> 