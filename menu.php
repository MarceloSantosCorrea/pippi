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
        	<li><a href="painel.php?exe=home/admin">In�cio</a></li>
            <h1>Clientes</h1>
            <li><a href="painel.php?exe=home/cadastro_clientes">Cadastrar Clientes</a></li>
            <li><a href="painel.php?exe=home/listar_clientes">Listagem de Clientes</a></li>
            <h1>Obriga��es</h1>
            <li><a href="painel.php?exe=home/cadastro_tarefas">Cadastro de Obriga��es</a></li>
            <li><a href="painel.php?exe=home/controle_tarefas">Atribui��o de Obriga��es</a></li>
            <li><a href="painel.php?exe=home/controle_honorarios">Pagamento de Honor�rios</a></li>
            <li><a href="painel.php?exe=home/controle_datas_obrigacoes">Datas das Obriga��es</a></li>
            <h1>Usu�rios</h1>
            <li><a href="painel.php?exe=home/cadastro_usuarios">Cadastrar Usu�rios</a></li>
            <li><a href="painel.php?exe=home/listar_usuarios">Listar Usu�rios</a></li>
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
