<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início &raquo; Atualização de Cadastro</div><!--caminho-->
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

?>
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
switch (get_post_action('salvar_fisico', 'deletar')) {
    case 'salvar_fisico':
       $cliente_id = $_POST['id'];
$cliente_nome = strip_tags(trim($_POST['nome']));
$cliente_cpf = strip_tags(trim($_POST['cpf']));
$cliente_endereco = strip_tags(trim($_POST['endereco']));
$cliente_num_endereco = strip_tags(trim($_POST['num_endereco']));
$cliente_bairro = strip_tags(trim($_POST['bairro']));
$cliente_compl_endereco = strip_tags(trim($_POST['compl_endereco']));
$cliente_ref_endereco = strip_tags(trim($_POST['ref_endereco']));
$cliente_cep = strip_tags(trim($_POST['cep']));
$cliente_cidade = strip_tags(trim($_POST['cidade']));
$cliente_estado = strip_tags(trim($_POST['estado']));
$cliente_fone_resid = strip_tags(trim($_POST['fone_resid']));
$cliente_fone_cel = strip_tags(trim($_POST['fone_cel']));
$cliente_email = strip_tags(trim($_POST['email']));
$cliente_aniversario = strip_tags(trim($_POST['aniversario']));
if($cliente_nome == ''){echo '<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_clientes_editar_cadastro&cliente='.$cliente_id.'">';}else{
$entrada = trim("$cliente_aniversario");
		 if(strstr($entrada, "/")){
			$aux = explode("/", $entrada); 
			$aux3 = $aux[2] . "-" . $aux[1] . "-" . $aux[0];
		 }

$cliente_data_modificado = date('Y-m-d H:i:s');
$cliente_cadastro_rg = strip_tags(trim($_POST['rg']));
$cliente_cadastro_orgao = strip_tags(trim($_POST['orgao']));
$cliente_cadastro_estado = strip_tags(trim($_POST['uf']));
$cliente_cadastro_data_expedicao = strip_tags(trim($_POST['data_expedicao']));
$cliente_cadastro_pai = strip_tags(trim($_POST['pai']));
$cliente_cadastro_mae = strip_tags(trim($_POST['mae']));

$sql_atualiza_fisico = 'UPDATE cadastro_clientes SET cliente_nome = :cliente_nome,
													    cliente_cpf = :cliente_cpf, 
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
                                      cliente_aniversario_timestamp = :cliente_aniversario, 
												cliente_cadastro_rg = :cliente_cadastro_rg,
										     cliente_cadastro_orgao = :cliente_cadastro_orgao,
											cliente_cadastro_estado = :cliente_cadastro_estado,
									cliente_cadastro_data_expedicao = :cliente_cadastro_data_expedicao,
									                    cliente_pai = :cliente_cadastro_pai,
								        	            cliente_mae = :cliente_cadastro_mae,
											     cliente_ordem_alfa = :cliente_ordem_alfa
						                           WHERE cliente_id = :cliente_id';
						
try{
	$query_atualiza_fisico = $conecta->prepare($sql_atualiza_fisico);
	$query_atualiza_fisico->bindValue(':cliente_id',$cliente_id,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_nome',$cliente_nome,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cpf',$cliente_cpf,PDO::PARAM_STR);
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
	$query_atualiza_fisico->bindValue(':cliente_aniversario',$aux3,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cadastro_rg',$cliente_cadastro_rg,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cadastro_orgao',$cliente_cadastro_orgao,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cadastro_estado',$cliente_cadastro_estado,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cadastro_data_expedicao',$cliente_cadastro_data_expedicao,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cadastro_pai',$cliente_cadastro_pai,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_cadastro_mae',$cliente_cadastro_mae,PDO::PARAM_STR);
	$query_atualiza_fisico->bindValue(':cliente_ordem_alfa',$cliente_nome,PDO::PARAM_STR);
	$query_atualiza_fisico->execute();
	echo'<script type="text/javascript">
	alert("Salvo com Sucesso.");
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/listar_clientes_editar_cadastro&cliente='.$cliente_id.'">';	
}catch(PDOexception $error_atualiza_fisico){
	echo'Erro ao Atualizar, favor tente novamente'.$error_atualiza_fisico->getMessage();
	}

}
     

 break;
    
    case 'deletar':
$id_cliente = $_GET['id'];

//////deletar o cadastro
$sql_cliente = 'DELETE FROM cadastro_clientes WHERE cliente_id = :id_cliente';

try{
	$query_cliente = $conecta->prepare($sql_cliente);
	$query_cliente->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_cliente->execute();
	
	}catch(PDOexception $error_honorarios){
		echo'Erro ao deletar o cadastro';}
		
		
/////deleta os cadastros de honorarios
$sql_delete_cliente_honorario = 'DELETE FROM honorario_mes WHERE mes_id_cliente = :id_cliente';		
try{
	$query_delete_cliente_honorario = $conecta->prepare($sql_delete_cliente_honorario);
	$query_delete_cliente_honorario->bindValue(':id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_delete_cliente_honorario->execute();
	}catch(PDOexception $error_deletar_honorario){
		echo'Erro ao deletar o cadastro'.$error_deletar_honorario->getMessage();}	
///////deletar a anivrsario da agenda
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