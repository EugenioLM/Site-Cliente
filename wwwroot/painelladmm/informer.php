<? if (PT!=1) exit;
if($_POST['acao'] == ''){ ?>
<?
if($_SESSION['permissao'] < 3){
echo "Voce nao tem permissao para acessar esta area";
exit;
}
?>
<style type="text/css">
<!--
.fonte {
	font-family: Verdana, Geneva, sans-serif;
}
-->
</style>
</head>

<body>

<table background="imgs/fundo_textura1.gif" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">
                  <tr>
                    <td colspan="2" align="center" bgcolor="#000000"><b><font color="#FFFFFF">
					Sistema de cr&eacute;ditos </font></b></td>
                  </tr>
<tr>

<form id="form" name="form" method="post">
  <td width="37%" align="right"><strong><font color="#000000">ID</font></strong></td>
  <td width="59%">                       
     <input type="text" name="id" id="id" />


          <tr>
                  <td colspan="2" align="center">
     <input type="submit" name="Obter" id="Obter" class="button6" value="Enviar" />
                    <input name="acao" type="hidden" id="acao" class="button6" value="acao" />
		            
                    
<BR><BR></tr>
                </table></td>
              </tr>
  </table>

<?
}else{
?>

<style type="text/css">
<!--
.fonte {
	font-family: Verdana, Geneva, sans-serif;
}
-->
</style>
</head>

<body>

<table background="imgs/fundo_textura1.gif" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">
                  <tr>
                    <td colspan="2" align="center" bgcolor="#000000"><b><font color="#FFFFFF">
					Sistema de cr&eacute;ditos </font></b></td>
                  </tr>
<tr>

<form id="form" name="form" method="post">
  <td width="37%" align="right"><strong><font color="#000000">ID</font></strong></td>
  <td width="59%">                       
     <input type="text" name="id" id="id" />


          <tr>
                  <td colspan="2" align="center">
     <input type="submit" name="Obter" id="Obter" class="button6" value="Enviar" />
                    <input name="acao" type="hidden" id="acao" class="button6" value="acao" />
		            
                    
<BR><BR>
<?php

if(anti_sql($_POST['id']) != 0){
echo 'Digite um id válido!';
exit;
}

$file = "$creditos".$_POST['id'].".arc";

if(!file_exists($file)){
echo 'ID n&atilde;o encontrada!';
exit;
}

$fp = fopen($file, "r");
$fr = fread($fp, filesize($file));
fclose($fp);

echo '<strong>'.$_POST['id'].'</strong> possui <strong>'.$fr.'</strong> cr&eacute;ditos!';

?></tr>
                </table></td>
              </tr>
  </table>

<?
}
?>