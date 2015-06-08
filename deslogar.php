<?php
// *** Logout the current user.
$logoutGoTo = "";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Painel de Controle</title>
<link href="painel_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="painel_login">
    	<img src="images/bruno_pippi_logo.png" alt="" title="" width="250" height="50" border="0" />
        <form name="login" action="" method="post">
        	<fieldset>
            	<legend>Área de Administração</legend>
                	<h1>Você deslogou com sucesso!</h1>
                    
                    <a href="index.php" class="link">Logar</a>
                    
                    
            </fieldset>
        </form>
    </div><!--painel_login-->
</body>
</html>