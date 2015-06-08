<?php include_once('sistema/restrito_admin.php');?>
<?php include_once('header.php');?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início</div><!--caminho-->
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
        	<div id="cadastro_tarefas">
            	<form name="cadastro_tarefas" action="" method="post" enctype="multipart/form-data">
                	<fieldset>
                    	<legend>Cadastro de Obrigações</legend>
<?php
if(isset($_POST['cad_obrigacao'])){
$obrigacao_tipo = $_POST['tipo'];
$obrigacao_md5 = md5($obrigacao_tipo);
if($obrigacao_tipo == ''){
	echo'<div class="error">Informe o Nome da Obrigação</div>';
	}else{
$obrigacao_repetida = mysql_query("SELECT * FROM cadastro_obrigacao WHERE obrigacao_nome = '$obrigacao_tipo'") or die (mysql_error());
if(@mysql_num_rows($obrigacao_repetida) >= 1){
	echo'<div class="error">Obrigação já Castrada.</div>';
	}else{

$vencimento = $_POST['data'];

if(strlen($vencimento == '5')){
	$data = $vencimento;
	}elseif(strlen($vencimento == '2')){

		$data = $vencimento;

}

 $contarCampo = count($vencimento);
for($i = 0; $i < $contarCampo; $i++){
	if(empty($vencimento[$i])){
		echo'<script type="text/javascript">
		alert("Existe campo(s) em branco e este(s), não podem ser cadastrados.");
		</script>';
		}else{
$sql_cadastra_data_vencimento_obrigacao = mysql_query("INSERT INTO cadastro_obrigacao (obrigacao_nome, obrigacao_data, obrigacao_md5) VALUES ('$obrigacao_tipo', '$data[$i]/0000', '$obrigacao_md5')") or die (mysql_error());

///////////seleciona buscar o id da obrigação cadastrada para cadastrar as datas		
$obrigacao = mysql_query("SELECT * FROM cadastro_obrigacao WHERE obrigacao_nome = '$obrigacao_tipo'") or die(mysql_error());

	while($res_obrig = mysql_fetch_array($obrigacao)){
		
		$id_obrigacao = $res_obrig['obrigacao_id'];
		$nome_obrigacao = $res_obrig['obrigacao_nome'];
		$md5_obrigacao = $res_obrig['obrigacao_md5'];
		}
///////////		
$sql_vencimento_obrigacao = mysql_query("INSERT INTO data_vencimento_obrigacao (obrig_data_vencimento, obrig_data_id_obrigacao, obrig_data_id_cadastro, obrig_data_nome_cadastro) VALUES ('$vencimento[$i]/0000', '$md5_obrigacao', '$id_obrigacao', '$nome_obrigacao')") or die (mysql_error());
	  }
	}		
  }
	}
  if($sql_vencimento_obrigacao >=1){
	  echo'<div class="ok">Tarefa cadastrada com Sucesso.</div>';
	  }
}

///////////cadatro de obrigação na agenda
$sql_busca_obrigacao = mysql_query("SELECT * FROM cadastro_obrigacao") or die (mysql_error());
	while($res_busca_obrigacao = mysql_fetch_array($sql_busca_obrigacao)){
			$obrigacao_id = $res_busca_obrigacao['obrigacao_id'];
			$obrigacao_nome = $res_busca_obrigacao['obrigacao_nome'];
			$obrigacao_data = $res_busca_obrigacao['obrigacao_data'];
$agenda_tipo = 'obrigacao';	
$data_invertida = substr($obrigacao_data,6,4)."-".substr($obrigacao_data,3,2)."-".substr($obrigacao_data,0,2).'<br />';//inverte a data da tabela obrigacao para comparar com o campo date da tebela pagina_agenda
$sql_busca_obrigacao_agenda = mysql_query("SELECT * FROM pagina_agenda WHERE agenda_data = '$data_invertida' AND agenda_evento = '$obrigacao_nome' AND agenda_tipo = '$agenda_tipo'") or die (mysql_error());

if(@mysql_num_rows($sql_busca_obrigacao_agenda) <= 0){	

$data_para_cadastrar = substr($obrigacao_data,6,4)."-".substr($obrigacao_data,3,2)."-".substr($obrigacao_data,0,2);	
$agendar = mysql_query("INSERT INTO pagina_agenda (agenda_evento, agenda_tipo, agenda_data, agenda_data_text) VALUES ('$obrigacao_nome', '$agenda_tipo', '$data_para_cadastrar','$obrigacao_id')") or die(mysql_error());

		
}//fecha foreach($resultado_busca_obrigacao as $res_busca_obrigacao){
/////////////////// fecha cadastro de obrigação na agenda
}
?>
                      <label>
                        	<span>Tipo de Obrigação</span>
                            <input type="text" name="tipo"   />
                      </label>
                      <label>
                      <div class="telefones" >
				<p class="campoTelefone" style="margin:5px 0;">
                
                	<span>Dia/Mês de vencimento</span>
                    <input type="text" name="data[]" id="data" maxlength="5" style="width:80px;"  /> ex:99/99
               
					<a href="#" class="removerCampo">Remover Campo</a>
				</p>
				</div>
				<p>
					<a href="#" class="adicionarCampo">Adicionar Data</a>
				</p>
                    
                      </label>
                     
                        <input type="submit" name="cad_obrigacao" value="Cadastrar" class="btn" />
                    </fieldset>
                </form>
         
            </div><!-- controle_tarefas -->
  
  		</div><!-- conteudo interno -->
</div><!-- conteudo -->
<?php include_once('atualizacoes_automaticas/CadastroDasAtribuicoesDasObrigacoesClientes.php');?>
<?php include_once('footer.php');?>


