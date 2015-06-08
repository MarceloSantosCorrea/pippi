<?php include_once('sistema/restrito_all.php');?>
<?php include_once('header.php');?>
<?php include"Scripts/limita_palavras.php";?>
   <div id="local">
   <div class="caminho"> Painel de Controle &raquo; Início</div><!--caminho-->
<?php
//////////////////////////////////////////////////////////////////
$logado = $_SESSION['MM_Username'];
$sql_select = 'SELECT * FROM login WHERE login_login = :logado';
try{
	$query_select = $conecta->prepare($sql_select);
	$query_select->bindValue(':logado',$logado,PDO::PARAM_STR);
	$query_select->execute();												//// recupera o nome do usuario que esta logado
	$result = $query_select->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select){
	echo'Erro ao selecionar';
	}
	foreach ($result as $res){
	 	$login_nome = $res['login_nome'];	
	}
///////////////////////////////////////////////////////////////////
?>
   <div class="welcome">Olá <?php echo $login_nome;?>| Hoje <?php echo date('d/m/Y');?> <span id="timer"></span> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
    
<?php include_once('menu.php');?> 
 
  
  <div id="conteudo">
  		<div id="conteudo_interno">
  				<div id="agenda">
                	<div id="sidebar">
                    	<div id="calendario">
                        	<form name="" action="" method="post" enctype="multipart/form-data">
                            	<label>
    	                    <input type="text" name="data_1"  id="data_1" class="input" maxlength="10" value="" >
                            <input type="submit" name="ir" value="ir" class="btn" />
                            	</label>
                            </form>
                        </div><!-- calendario -->
                        <div id="cadastro_evento">
                        	<form name="cadastro_eventos" action="" method="post" enctype="multipart/form-data">
                            	<fieldset>
                                	<legend>Cadastrar Eventos</legend>
                                	
<?php 
if(isset($_POST['cadastrar'])){
//////////////////// para cadastrar a data em timestamp
$dia_cadastrar = $_POST['data_2'];
$entrada = trim("$dia_cadastrar");
		 if(strstr($entrada, "/")){
			$aux = explode("/", $entrada); 
			$aux3 = $aux[2] . "-" . $aux[1] . "-" . $aux[0];
		 }
//////////////////////////////////////////////////////////
$agenda_evento = $_POST['descricao'];
$agenda_horario = $_POST['horario'];
$agenda_tipo = 'manualmente';
if($dia_cadastrar == ''){
	echo'<div class="no">Informe a data!</div>';
}elseif($agenda_evento == ''){
	echo '<div class="no">Informe a descrição do evento</div>';
}else{
$agendar = 'INSERT INTO pagina_agenda (agenda_data, agenda_evento, agenda_horario, agenda_tipo) VALUES (:agenda_data, :agenda_evento,
									  :agenda_horario, :agenda_tipo)';
try{
	$query_insert_evento = $conecta->prepare($agendar);
	$query_insert_evento->bindValue(':agenda_data',$aux3,PDO::PARAM_STR);
	$query_insert_evento->bindValue(':agenda_evento',$agenda_evento,PDO::PARAM_STR);
	$query_insert_evento->bindValue(':agenda_horario',$agenda_horario,PDO::PARAM_STR);
	$query_insert_evento->bindValue(':agenda_tipo',$agenda_tipo,PDO::PARAM_STR);
	$query_insert_evento->execute();
	echo'<h1>Agendado com Sucesso!</h1>';
	}catch(PDOexception $error_agenda){
		echo'Erro ao Agendar Evento'.$error_agenda->getMessage();
		}
}}
?>
                                    	<label>	
                                        	<span>Data:</span>
                                            <input type="text" name="data_2"  id="data_2" >
                                        </label>
                                       	<label>	
                                        	<span>Descrição</span>
                                            <input type="text" name="descricao" />
                                        </label>
                                     	<label>	
                                        	<span>Horário</span>
                                            <select name="horario">
                                            	<option></option>
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
                                                
                                                <input type="submit" name="cadastrar" value="Salvar" class="btn" />
                                        </label> 
                                        	 
                                        </fieldset>
                            </form>
                        </div><!-- cadastro_evento -->
                    </div><!-- sidebar -->
                    <div id="compromissos">
                    	<div id="datas">
                        	<div id="barra_status">
<span><strong>
<?php if(isset($_POST['ir'])){
$localizar_dia = $_POST['data_1'];
$hoje = date('d/m/Y');
if($localizar_dia == ''){
	echo $hoje;
	}else{
		$dia = $localizar_dia;
$data=substr($dia,0,2)."-".$mes=substr($dia,3,2)."-".$ano=substr($dia,6,4);

$diasemana = date("w", strtotime($data));

switch($diasemana) {
case"0": $dia_semana = "domingo"; break;
case"1": $dia_semana = "Segunda-feira"; break;
case"2": $dia_semana = "Terça-feira"; break;
case"3": $dia_semana = "Quarta-feira"; break;
case"4": $dia_semana = "Quinta-feira"; break;
case"5": $dia_semana = "Sexta-feira"; break;
case"6": $dia_semana = "Sábado"; break;

}
echo $localizar_dia.' - '.$dia_semana;
	} }
?></strong>Voltar para hoje: <a href="painel.php?exe=home/admin"><?php echo date('d/m/Y');?></a></span>
                            </div><!-- barra_status -->
                        </div><!-- datas -->
                        <div id="descricao_evento">
                        	
<?php
/////////////////////////// recupera os eventos ja cadastrados
if(!isset($_POST['ir']) or (isset($_POST['ir']) and $localizar_dia == '')){ ///////// !isset recupera os eventos quando abre a página.

$hoje = date('Y-m-d');
$hoje2 = date('0000-m-d');
$hoje3 = date('0000-00-d');
	

$sql_select_agenda = 'SELECT * FROM pagina_agenda WHERE agenda_data = :hoje OR agenda_data = :hoje2 OR agenda_data = :hoje3 ORDER BY agenda_horario' ;
try{
	$query_agenda = $conecta->prepare($sql_select_agenda);
	$query_agenda->bindValue(':hoje3',$hoje3,PDO::PARAM_STR);
	$query_agenda->bindValue(':hoje2',$hoje2,PDO::PARAM_STR);
	$query_agenda->bindValue(':hoje',$hoje,PDO::PARAM_STR);
	$query_agenda->execute();
	$result_agenda = $query_agenda->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $error_select_agenda){
		echo'Erro ao selecionar Evento'.$error_select_agenda->getMessage();
		}
	foreach($result_agenda as $res_agenda){
		 $agenda_id = $res_agenda['agenda_id'];
		 $hora = $res_agenda['agenda_horario'];
         $descricao = $res_agenda['agenda_evento'];
		 $agenda_id_cliente = $res_agenda['agenda_id_cliente'];
		 $tipo_agenda = $res_agenda['agenda_tipo'];
?>
<?php /////////////buscar o id do cliente
$sql_id_cliente = 'SELECT * FROM cadastro_clientes WHERE cliente_id = :agenda_id_cliente';
try{
	$query_id_cliente = $conecta->prepare($sql_id_cliente);
	$query_id_cliente->bindValue(':agenda_id_cliente',$agenda_id,PDO::PARAM_STR);
	$query_id_cliente->execute();
	$result_id_cliente = $query_id_cliente->fetchAll(PDO::FETCH_ASSOC);
	
		}catch(PDOexception $erro_id_cliente){
		echo'Erro ao selecionar o id do cliente'.$erro_id_cliente->getMessage();
		}
		foreach($result_id_cliente as $res){
			$id_cliente = $res['cliente_id'];
			$ids_clientes = array($id_cliente);
		
		}
if(isset($hora)){
?>
							<div id="hora">
                            	<span><?php echo $hora; ?></span>
                            </div><!-- hora --><?php }?>
                            <div id="evento">
                            	<span><?php echo str_truncate($descricao, 60, $rep).' ...';?></span>
                                
							<a href="
<?php if($tipo_agenda == 'aniversario'){?>javascript:abrir('info_ani.php?&amp;id=<?php echo $agenda_id_cliente;?>&amp;evento=<?php echo $agenda_id;?>' ,'600','400')<?php }				if($tipo_agenda == 'manualmente'){?>javascript:abrir('info_evento.php?&amp;id=<?php echo $agenda_id_cliente;?>&amp;evento=<?php echo $agenda_id;?>' ,'600','400')<?php }
if($tipo_agenda == 'obrigacao'){?>javascript:abrir('info_obrigacao.php?&amp;evento=<?php echo $descricao;?>' ,'600','400')<?php }?>
                            ">veja +</a>
                            </div><!-- evento -->
<?php }} else{?>
<?php if(isset($_POST['ir'])){
$localizar_dia = $_POST['data_1'];
$entrada = trim("$localizar_dia");
		 if(strstr($entrada, "/")){
			$aux = explode("/", $entrada); 
			$aux5 ='0000-00'. "-" . $aux[0];
		 }
$entrada = trim("$localizar_dia");
		 if(strstr($entrada, "/")){
			$aux = explode("/", $entrada); 
			$aux3 ='0000-'.$aux[1] . "-" . $aux[0];
		 }

$entrada = trim("$localizar_dia");
		 if(strstr($entrada, "/")){
			$aux = explode("/", $entrada); 
			$aux4 = $aux[2] .'-'.$aux[1] . "-" . $aux[0];
		 }
$sql_busca = 'SELECT * FROM pagina_agenda WHERE agenda_data = :localizar_dia3 OR agenda_data = :localizar_dia2 OR agenda_data = :localizar_dia ORDER BY agenda_horario';
try{
	$query_busca = $conecta->prepare($sql_busca);
	$query_busca->bindValue(':localizar_dia2',$aux3,PDO::PARAM_STR);
	$query_busca->bindValue(':localizar_dia',$aux4,PDO::PARAM_STR);
	$query_busca->bindValue(':localizar_dia3',$aux5,PDO::PARAM_STR);
	
	$query_busca->execute();
	$resultado_busca = $query_busca->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOexception $erro_busca){
		echo'Erro ao localizar outras datas'.$erro_busca->getMessage();
		}
		foreach($resultado_busca as $res_busca){
			$agenda_id = $res_busca['agenda_id'];
		  $agenda_data = $res_busca['agenda_data'];
			     $hora = $res_busca['agenda_horario'];
            $descricao = $res_busca['agenda_evento'];
   $agenda_aniversario = $res_busca['agenda_aniversario'];
	 $agenda_ano_atual = $res_busca['ano_atual'];
	   	  $tipo_agenda = $res_busca['agenda_tipo'];
    $agenda_id_cliente = $res_busca['agenda_id_cliente'];
			if(isset($hora)){
?>
							<div id="hora">
                            	<span><?php echo $hora; ?></span>
                            </div><!-- hora --><?php }?>
                            <div id="evento">
                            	<span><?php echo str_truncate($descricao, 60, $rep).' ...';?> </span>
                                <a href="
<?php if($tipo_agenda == 'aniversario'){?>javascript:abrir('info_ani.php?&amp;id=<?php echo $agenda_id_cliente;?>&amp;evento=<?php echo $agenda_id;?>' ,'600','400')
<?php }if($tipo_agenda == 'manualmente'){?>javascript:abrir('info_evento.php?&amp;id=<?php echo $agenda_id_cliente;?>&amp;evento=<?php echo $agenda_id;?>' ,'600','400')
<?php }if($tipo_agenda == 'obrigacao'){?>javascript:abrir('info_obrigacao.php?&amp;evento=<?php echo $descricao;?>' ,'600','400')<?php
}?>">
veja +</a>
                            </div><!-- evento -->
<?php }}}?>
                          
                        </div><!-- descricao_evento -->
                    </div><!-- compromissos -->
                </div><!-- agenda -->
  		</div><!-- conteudo interno -->
    </div><!-- conteudo -->
<!--Cadastro dos meses dos honorarios-->
<?php include_once('atualizacoes_automaticas/CadastroAnos.php');?>
<?php include_once('atualizacoes_automaticas/CadastroDosMesesNaTabelaHonorario.php');?>
<?php include_once('atualizacoes_automaticas/CadastroDasDatasDasObrigacoesNaAgenda.php');?>
<?php include_once('atualizacoes_automaticas/UdateCadastroObrigacoesParaDataVemncimentoObrigacoes.php');?>

<?php include_once('footer.php');
