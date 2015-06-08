<?php include_once('Connections/config_pdo.php');?>
<?php
$logado_menu = $_SESSION['MM_Username'];
$sql_select_menu = 'SELECT * FROM login WHERE login_login = :logado_menu';
try{
	$query_select_menu = $conecta->prepare($sql_select_menu);
	$query_select_menu->bindValue(':logado_menu',$logado_menu,PDO::PARAM_STR);
	$query_select_menu->execute();
	$result_menu = $query_select_menu->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $error_select_menu){
	echo'Erro ao selecionar';
	}
	foreach ($result_menu as $res_menu){
	 	$login_menu = $res_menu['login_nivel'];	
	}
if($login_menu == 'admin' or $login_menu == 'tecnico'){
?>
<div id="menu">
    	<ul>
        	<li><a href="painel.php?exe=home/admin">Início</a></li>
            <h1>Clientes</h1>
            <li><a href="painel.php?exe=home/cadastro_clientes">Cadastrar Clientes</a></li>
            <li><a href="painel.php?exe=home/listar_clientes">Listagem de Clientes</a></li>
            <h1>Obrigações</h1>
            <li><a href="painel.php?exe=home/cadastro_tarefas">Cadastro de Obrigações</a></li>
            <li><a href="painel.php?exe=home/controle_tarefas">Atribuição de Obrigações</a></li>
            <li><a href="painel.php?exe=home/controle_honorarios">Pagamento de Honorários</a></li>
            <li><a href="painel.php?exe=home/controle_datas_obrigacoes">Datas das Obrigações</a></li>
            <h1>Usuários</h1>
            <li><a href="painel.php?exe=home/cadastro_usuarios">Cadastrar Usuários</a></li>
            <li><a href="painel.php?exe=home/listar_usuarios">Listar Usuários</a></li>
            <li><a href="painel.php?exe=home/perfil">Alterar Perfil</a></li>
            <h1>FID</h1>
            <li><a href="painel.php?exe=home/fid">Buscar</a></li>
            <h1>Recibo</h1>
            <li><a href="painel.php?exe=home/recibo">Gerar</a></li>
            <li><a href="painel.php?exe=home/listar_recibos">Localizar</a></li>
            
            
            
      </ul>
    </div><!-- menu -->
<?php
}
if($login_menu == 'usuario'){
?>
<div id="menu">
    	<ul>
        	<h1>FID</h1>
            <li><a href="painel.php?exe=home/fid">Buscar</a></li>
            <h1>Recibo</h1>
            <li><a href="painel.php?exe=home/recibo">Gerar</a></li>
            <li><a href="painel.php?exe=home/listar_recibos">Localizar</a></li>
        </ul>
    </div><!-- menu -->
<?php	
}
?>
