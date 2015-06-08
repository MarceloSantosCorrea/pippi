<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início &raquo; Confirmação de Cadastro</div><!--caminho-->
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
<?php if(isset($_POST['cadastrar'])){
$inputRadio = $_POST['radio'];
$cliente_nome = strip_tags(trim($_POST['nome']));
$cliente_razao = strip_tags(trim($_POST['razao']));
$cliente_fantasia = strip_tags(trim($_POST['fantasia']));
$cliente_cpf = strip_tags(trim($_POST['cpf']));
$cliente_cnpj = strip_tags(trim($_POST['cnpj']));
$cliente_insc_estadual = strip_tags(trim($_POST['insc_estadual']));
$cliente_cpf_responsavel = strip_tags(trim($_POST['cpf_reponsavel']));
$cliente_endereco = strip_tags(trim($_POST['endereco']));
$cliente_num_endereco = strip_tags(trim($_POST['numero_end']));
$cliente_bairro = strip_tags(trim($_POST['bairro']));
$cliente_compl_endereco = strip_tags(trim($_POST['compl_end']));
$cliente_ref_endereco = strip_tags(trim($_POST['referencia']));
$cliente_cep = strip_tags(trim($_POST['cep']));
$cliente_fone_resid = strip_tags(trim($_POST['fone_resid']));
$cliente_fone_cel = strip_tags(trim($_POST['fone_cel']));
$cliente_cidade = strip_tags(trim($_POST['cidade']));
$cliente_uf = strip_tags(trim($_POST['uf']));
$cliente_email = strip_tags(trim($_POST['email']));
$cliente_aniversario_dia = strip_tags(trim($_POST['aniversario_dia']));
$cliente_aniversario_mes = strip_tags(trim($_POST['aniversario_mes']));
$cliente_aniversario_ano = strip_tags(trim($_POST['aniversario_ano']));
$cliente_aniversario = '0000-'.$cliente_aniversario_mes.'-'.$cliente_aniversario_dia;
$cliente_aniversario_timestamp = $cliente_aniversario_ano.'-'.$cliente_aniversario_mes.'-'.$cliente_aniversario_dia; 

$cliente_cadastro_rg = strip_tags(trim($_POST['rg']));
$cliente_cadastro_orgao = strip_tags(trim($_POST['org_expe']));
$cliente_cadastro_estado = strip_tags(trim($_POST['estado_rg']));
$cliente_cadastro_data_expedicao = strip_tags(trim($_POST['expedicao']));
$cliente_cadastro_pai = strip_tags(trim($_POST['pai']));
$cliente_cadastro_mae = strip_tags(trim($_POST['mae']));


$cliente_data_cadastro = date('Y-m-d H:i:s');
$cliente_data_modificado = date('Y-m-d H:i:s');
$cliente_cadastrado_por = $login_nome;

if(empty($cliente_razao) and empty($cliente_nome))
{echo'<script type="text/javascript">
	alert("Informe o Nome do Cliente!");	
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_clientes">
			';}else

if($cliente_aniversario_dia != '-1' and $cliente_aniversario_mes =='-1' and $cliente_aniversario_ano =='-1'){
	echo'<script type="text/javascript">
	alert("Informe o Mês do Aniversario!");	
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_clientes">
			';
	
	}elseif($cliente_aniversario_dia != '-1' and $cliente_aniversario_mes != '-1'  and $cliente_aniversario_ano =='-1'){
		echo'<script type="text/javascript">
	alert("Informe o Ano do Aniversario!");	
	</script>
	<meta http-equiv="refresh" content="0; url=painel.php?exe=home/cadastro_clientes">
			';
		}else{

$sql_cadastra_cliente = 'INSERT INTO cadastro_clientes 
						 (cliente_nome, cliente_razao, cliente_fantasia, cliente_cnpj, cliente_cpf, cliente_insc_estadual, cliente_cpf_responsavel, cliente_email, cliente_fone_resid, cliente_fone_cel,
						  cliente_data_cadastro, cliente_data_modificado, cliente_endereco, cliente_num_endereco, cliente_compl_endereco, cliente_ref_endereco, cliente_cep, 
						  cliente_bairro, cliente_cadastrado_por, cliente_aniversario_timestamp, cliente_cadastro_rg, cliente_cadastro_orgao,
						  cliente_cadastro_estado, cliente_cadastro_data_expedicao, cliente_pai, cliente_mae, cliente_cidade, cliente_estado) ';
$sql_cadastra_cliente .='VALUES 
						(:cliente_nome, :cliente_razao, :cliente_fantasia, :cliente_cnpj, :cliente_cpf, :cliente_insc_estadual,:cliente_cpf_responsavel, :cliente_email, :cliente_fone_resid, 
						:cliente_fone_cel, :cliente_data_cadastro, :cliente_data_modificado, :cliente_endereco, :cliente_num_endereco, :cliente_compl_endereco,
						:cliente_ref_endereco, :cliente_cep, :cliente_bairro, :cliente_cadastrado_por, 
						:cliente_aniversario_timestamp, :cliente_cadastro_rg, :cliente_cadastro_orgao, :cliente_cadastro_estado, :cliente_cadastro_data_expedicao, :cliente_pai, :cliente_mae, :cliente_cidade, :cliente_estado)'; 
						
try{
	$query_cadastra = $conecta->prepare($sql_cadastra_cliente);
	$query_cadastra->bindValue(':cliente_nome',$cliente_nome,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_razao',$cliente_razao,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_fantasia',$cliente_fantasia,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cnpj',$cliente_cnpj,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cpf',$cliente_cpf,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_insc_estadual',$cliente_insc_estadual,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cpf_responsavel',$cliente_cpf_responsavel,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_pai',$cliente_cadastro_pai,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_mae',$cliente_cadastro_mae,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_email',$cliente_email,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_fone_resid',$cliente_fone_resid,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_fone_cel',$cliente_fone_cel,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cidade',$cliente_cidade,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_estado',$cliente_uf,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_data_cadastro',$cliente_data_cadastro,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_data_modificado',$cliente_data_modificado,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_endereco',$cliente_endereco,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_num_endereco',$cliente_num_endereco,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_compl_endereco',$cliente_compl_endereco,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_ref_endereco',$cliente_ref_endereco,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cep',$cliente_cep,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_bairro',$cliente_bairro,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cadastrado_por',$cliente_cadastrado_por,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_aniversario_timestamp',$cliente_aniversario_timestamp,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cadastro_rg',$cliente_cadastro_rg,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cadastro_orgao',$cliente_cadastro_orgao,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cadastro_estado',$cliente_cadastro_estado,PDO::PARAM_STR);
	$query_cadastra->bindValue(':cliente_cadastro_data_expedicao',$cliente_cadastro_data_expedicao,PDO::PARAM_STR);
	$query_cadastra->execute();
	echo'<h1>Cadastrado com Sucesso!</h1>';
	
$sqlClientes = mysql_query ("select * from cadastro_clientes ") or die (mysql_error());
while($res = mysql_fetch_array($sqlClientes)){
	$nome = $res['cliente_nome'];
	$razao = $res['cliente_razao'];
	$id = $res['cliente_id'];
	
	
	
	if($nome == ''){
		$cliente = $razao;
		}else if ($razao == ''){
			$cliente = $nome;
			}
		
	$update = mysql_query ("update cadastro_clientes set cliente_ordem_alfa = '$cliente' where cliente_id = '$id'") or die (mysql_error());		
	}
		
//cadastro dos honorarios
$sql_select_listagem = 'SELECT * FROM cadastro_clientes WHERE cliente_nome = :cliente_nome OR cliente_razao = :cliente_razao';

try{
	$query_select_cliente = $conecta->prepare($sql_select_listagem);
	$query_select_cliente->bindValue(':cliente_nome',$cliente_nome,PDO::PARAM_STR);
	$query_select_cliente->bindValue(':cliente_razao',$cliente_razao,PDO::PARAM_STR);
	$query_select_cliente->execute();
	$resultado_clientes = $query_select_cliente->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select_cliente){
	echo'Erro ao selecionar clientes'.$error_select_cliente->getMessage();
	}
	
	foreach($resultado_clientes as $res_clientes){
		$id_cliente = $res_clientes['cliente_id'];
		

	}
	
								/////////////////cadastro de meses e ano atual na tabala de honorarios
$ano_atual = date('Y');
$sql_busca_ano_atual = 'SELECT * FROM honorario_mes WHERE mes_ano_atual = :mes_ano_atual AND mes_id_cliente = :mes_id_cliente';
try{
	$query_busca_ano_atual = $conecta->prepare($sql_busca_ano_atual);
	$query_busca_ano_atual->bindValue(':mes_ano_atual',$ano_atual,PDO::PARAM_STR);
	$query_busca_ano_atual->bindValue(':mes_id_cliente',$id_client_honorario,PDO::PARAM_STR);
	$query_busca_ano_atual->execute();
	
	$resultado_busca_ano_atual = $query_busca_ano_atual->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erro_busca_ano_atual){
		echo $erro_busca_ano_atual->getMessage();}
	foreach($resultado_busca_ano_atual as $res_busca_ano_atual){
		$honorario_ano_atual = $res_busca_ano_atual['mes_ano_atual'];
		$honorario_id_cliente = $res_busca_ano_atual['mes_id_cliente'];
		$honorario_mes_nome = $res_busca_ano_atual['mes_nome'];
		
		}
if($honorario_ano_atual == '' or $honorario_id_cliente != $id_client_honorario and $honorario_mes_nome == 0){	
$mes = array('Jan', 'Fev', 'Mar' ,'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
for($i = 0 ;$i < 12; $i++){
$ano = date('Y');
$mes_pago = 'nao';
$cadastro_mes_honorario = 'INSERT INTO honorario_mes (mes_nome, mes_ano_atual, mes_id_cliente , mes_pago) VALUES (:mes_nome, :mes_ano_atual, :mes_id_cliente, :mes_pago)';
	try{
	$query_cadastro_mes_honorario = $conecta->prepare($cadastro_mes_honorario);
	$query_cadastro_mes_honorario->bindValue(':mes_nome',$mes[$i].'/'.$ano_atual,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->bindValue(':mes_ano_atual',$ano_atual,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->bindValue(':mes_id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->bindValue(':mes_pago',$mes_pago,PDO::PARAM_STR);
	$query_cadastro_mes_honorario->execute();
	
	}catch(PDOexception $erro_cadastro_mes_honorario){
		echo'Erro ao localizar outras datas'.$erro_cadastro_mes_honorario->getMessage();
		}}}	
///////////////////////// cadastrar aniversario na agenda
if($cliente_razao == ''){
$agenda_evento = $cliente_nome." está de aniversario!!!";
}if($cliente_nome == ''){$agenda_evento = $cliente_razao." está de aniversario!!!";}
////////////////////
$entrada = trim("$cliente_aniversario");
		 if(strstr($entrada, "/")){
			$aux = explode("/", $entrada); 
			$aux3 = $aux[2] . "-" . $aux[1] . "-" . $aux[0];
		 }
////////////////////
$agenda_tipo = 'aniversario';
$aniversario_agenda = 'INSERT INTO pagina_agenda (agenda_data, agenda_evento, agenda_id_cliente, agenda_tipo) VALUES (:agenda_data, :agenda_evento, :agenda_id_cliente, :agenda_tipo)';		
try{
	$query_aniversario_agenda = $conecta->prepare($aniversario_agenda);
	$query_aniversario_agenda->bindValue(':agenda_data',$cliente_aniversario,PDO::PARAM_STR);
	$query_aniversario_agenda->bindValue(':agenda_evento',$agenda_evento,PDO::PARAM_STR);
	$query_aniversario_agenda->bindValue(':agenda_id_cliente',$id_cliente,PDO::PARAM_STR);
	$query_aniversario_agenda->bindValue(':agenda_tipo',$agenda_tipo,PDO::PARAM_STR);
	$query_aniversario_agenda->execute();
	}catch(PDOexception $erro_aniversario_agenda){
		echo'Erro ao cadastrar a data de aniversario na agenda'.$erro_aniversario_agenda->getMessage();
		}		
////////////////////// fim cadastro na agenda		
}catch(PDOexception $error_cadastra){
	echo'Erro ao Cadastrar, favor tente novamente'.$error_cadastra->getMessage();
	}

}
}?>
        
  	<p><a href="painel.php?exe=home/atribuicao&cliente=<?php echo $id_cliente; ?>">Atribuir obrigações para este cliente.</a></p>	
        </div><!-- conteudo interno -->
    </div><!-- conteudo -->
<?php include_once('atualizacoes_automaticas/CadastroDasAtribuicoesDasObrigacoesClientes.php');?>
<?php include_once('footer.php');?>