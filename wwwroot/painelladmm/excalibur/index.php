<? if (PT!=1) exit; 
if($_SESSION['permissao'] < 3){
echo "Voc� n�o tem permiss�o para acessar esta �rea";
exit;
}
?>

<?php
include_once "injection.php";
include_once "incluir/configura.php";

$banned = "banned.ini";
$file = "$rootDir$banned";
$fp = file_get_contents($file);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
					Editar Banned.ini Excalibur </font></b></td>
                  </tr>
<tr>


<tr>
                  <td colspan="2" align="center"><form id="form1" name="form1" method="post" action="index.php?sessadm=bannededit">
                    <p>
                      <label>
                        <textarea name="banned" cols="80" rows="30" id="banned"><?php echo $fp; ?></textarea>
                      </label>
                    </p>
                    <p>
                      <label>
                        <input type="submit" name="Editar" id="Editar" class="button6" value="Editar" />
                      </label>
                    </p>
                  </form>                  
                  </tr>
                </table></td>
              </tr>
  </table>
</body>
</html>