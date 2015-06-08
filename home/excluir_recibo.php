<?php include_once('conexao.php');?>
<?php
$excluir = $_GET['recibo'];
$DeleteRecibo = mysql_query ("DELETE FROM recibo WHERE reciboId = '$excluir'") or die (mysql_error());
echo'<script type="text/javascript">
alert("Recibo excluido com Sucesso.");
</script>
<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_recibos">
';

?>