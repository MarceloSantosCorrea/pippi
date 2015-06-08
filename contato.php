<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once('Connections/config_pdo.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div id="contato">
<style type="text/css">
#contato{width:600px; height:400px; background:#f4f4f4;margin:80px auto;}
#contato form {width:500px; height:300px; float:left; margin:40px;}
#contato fieldset{margin:5px 0 0 0; width:500px; height:300px; margin:0; float:left;}
#contato label{display:block; float:left; margin:10px 0 0 45px;}
#contato span{width:80px; float:left;}
#contato input{width:300px; float:left; padding:3px;}
#contato textarea{width:300px; float:left;}
#contato .btn{width:80px; float:left; margin:15px 0 0 124px; }
.ok{background:#D8FFB0; border:1px solid #0F0; width:180px; float:left; color:#666; text-align:center; margin:15px;}
</style>
<form name="contato" action="" enctype="multipart/form-data" method="post">
	<fieldset>
	<label>
    	<span>Nome</span>
        <input type="text" name="nome" />
    </label>
    <label>
    	<span>Email</span>
        <input type="text" name="email" />
    </label>
    <label>
    	<span>Telefone</span>
        <input type="text" name="telefone" />
    </label>
    <label><span>Assunto</span>
    <textarea name="assunto" rows="5">
    </textarea>
    </label>
	<input type="submit" name="enviar" value="Enviar" class="btn" />
<?php
if(isset($_POST['enviar'])){
$nome = strip_tags(trim($_POST['nome']));
$email = strip_tags(trim($_POST['email']));
$telefone = strip_tags(trim($_POST['telefone']));
$mensagem = strip_tags(trim($_POST['assunto']));

$mail_data = date('d/m/Y H:i:s');
		  $meuEmail = 'marcelo_tec_informatica@yahoo.com.br';
		  $assunto = 'Mensagem de contato de site '.$nome;
		  $headers = "From: $email\n";
		  $header .= "content-type: text/html; charset=iso-8859-1\n\n";
		  $mensagemSistema = '
		  
		  Contato:
		  Cliente Nome:'.$nome.'
		  Cliente E-mail: '.$email.'
		  Mensagem:'.$mensagem.'
		  
		  Mensagem enviada em: '.$mail_data.'';
		  mail($meuEmail,$assunto,$mensagemSistema,$headers);

echo '<div class="ok">Enviado com Sucesso.</div>';	
}
?>
    	
    </fieldset>
</form>
</div><!-- contato -->
</body>
</html>