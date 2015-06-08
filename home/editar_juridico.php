<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início &raquo; Confirmação de Cadastro juridico</div><!--caminho-->
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
<?php 

function get_post_action($name)
{
    $params = func_get_args();
    
    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}
switch (get_post_action('salvar_juridico', 'deletar')) {
    case 'salvar_juridico':

$cliente_id = $_POST['id'];
$cliente_razao = strip_tags(trim($_POST['razao']));
$cliente_fantasia = strip_tags(trim($_POST['fantasia']));
$cliente_cnpj = strip_tags(trim($_POST['cnpj']));
$cliente_insc_estadual = strip_tags(trim($_POST['insc_estadual']));
$cliente_endereco = strip_tags(trim($_POST['endereco_juridico']));
$cliente_num_endereco = strip_tags(trim($_POST['num_endereco_juridico']));
$cliente_bairro = strip_tags(trim($_POST['bairro_juridico']));
$cliente_compl_endereco = strip_tags(trim($_POST['compl_endereco_juridico']));
$cliente_ref_endereco = strip_tags(trim($_POST['ref_endereco_juridico']));
$cliente_cep = strip_tags(trim($_POST['cep_juridico']));
$cliente_cidade = strip_tags(trim($_POST['cidade_juridico']));
$cliente_estado = strip_tags(trim($_POST['estado_juridico']));
$cliente_fone_resid = strip_tags(trim($_POST['fone_resid_juridico']));
$cliente_fone_cel = strip_tags(trim($_POST['fone_cel_juridico']));
$cliente_email = strip_tags(trim($_POST['email_juridico']));
$cpf_responsavel = strip_tags(trim($_POST['cpf_responsavel']));
$cliente_data_modificado = date('Y-m-d H:i:s');

if($cliente_razao == ''){
	echo'<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_clientes_editar_cadastro&cliente='.$cliente_id.'">';
	}else{

$sql_atualiza_fisica = 'UPDATE cadastro_clientes SET cliente_razao = :cliente_razao,
											    cliente_fantasia = :cliente_fantasia,
												        cliente_cnpj = :cliente_cnpj,
								      cliente_insc_estadual = :cliente_insc_estadual,
									                  cliente_email = :cliente_email,
										    cliente_fone_resid = :cliente_fone_resid,
                                                cliente_fone_cel = :cliente_fone_cel,
								  cliente_data_modificado = :cliente_data_modificado,
								                cliente_endereco = :cliente_endereco,
                                        cliente_num_endereco = :cliente_num_endereco,
								    cliente_compl_endereco = :cliente_compl_endereco,
									    cliente_ref_endereco = :cliente_ref_endereco,
                                                          cliente_cep = :cliente_cep,
												    cliente_cidade = :cliente_cidade,
												    cliente_estado = :cliente_estado,
												    cliente_bairro = :cliente_bairro,
								  cliente_cpf_responsavel = :cliente_cpf_responsavel,
								            cliente_ordem_alfa = :cliente_ordem_alfa
										             WHERE cliente_id = :cliente_id';
try{
	$query_atualiza_fisico = $conecta->prepare($sql_atualiza_fisica);
    $query_atualiza_fisico->bindValue(':cliente_id',$cliente_id,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_razao',$cliente_razao,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_fantasia',$cliente_fantasia,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cnpj',$cliente_cnpj,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_insc_estadual',$cliente_insc_estadual,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_email',$cliente_email,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_fone_resid',$cliente_fone_resid,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_fone_cel',$cliente_fone_cel,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_data_modificado',$cliente_data_modificado,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_endereco',$cliente_endereco,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_num_endereco',$cliente_num_endereco,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_compl_endereco',$cliente_compl_endereco,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_ref_endereco',$cliente_ref_endereco,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cep',$cliente_cep,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cidade',$cliente_cidade,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_estado',$cliente_estado,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_bairro',$cliente_bairro,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cpf_responsavel',$cpf_responsavel,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_ordem_alfa',$cliente_razao,PDO::PARAM_STR);
	$query_atualiza_fisico->execute();
	echo'<script type="text/javascript">
	alert("Salvo com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_clientes_editar_cadastro&cliente='.$cliente_id.'">';
}catch(PDOexception $error_atualiza_juridico){
	echo'Erro ao Atualizar, favor tente novamente'.$error_atualiza_juridico->getMessage();
	}}
	 break;
    
    case 'deletar':
$id_cliente = $_GET['id'];
$sql_cliente = 'DELETE FROM cadastro_clientes WHERE cliente_id = :id_cliente';

try{
	$query_cliente = $conecta->prepare($sql_cliente);
	$query_cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_cliente->execute();
	
	}catch(PDOexception $error_honorarios){
		echo'Erro ao deletar o cadastro';}
$sql_delete_cliente_honorario = 'DELETE FROM honorario_mes WHERE mes_id_cliente = :id_cliente';		
try{
	$query_delete_cliente_honorario = $conecta->prepare($sql_delete_cliente_honorario);
	$query_delete_cliente_honorario->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_delete_cliente_honorario->execute();
	}catch(PDOexception $error_deletar_honorario){
		echo'Erro ao deletar o cadastro'.$error_deletar_honorario->getMessage();}	
///
$sqlDeletaAniversarioAgenda = 'DELETE FROM pagina_agenda WHERE agenda_id_cliente = :id_cliente';
try{
	$queryDeletaAniversarioAgenda = $conecta->prepare($sqlDeletaAniversarioAgenda);
	$queryDeletaAniversarioAgenda->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$queryDeletaAniversarioAgenda->execute();
	}catch(PDOexception $erroDeletaAniversarioAgenda){
		echo'erro ao deletar o registro na pagina_agenda'.$erroDeletaAniversarioAgenda->getMessage();
		}
		
		echo'
	
	<script type="text/javascript">
	alert("Excluido com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_clientes">
	';	
	        break;
    
  
}	

?>
          		
        </div><!-- conteudo interno -->
    </div><!-- conteudo -->

<?php include_once('footer.php');?>