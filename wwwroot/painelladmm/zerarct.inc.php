<?
if (PT!=1) exit;
?>
<?
include_once "injection.php";
include_once "incluir/configura.php";
?>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<link href="css/style.css" rel="stylesheet" type="text/css">
<table background="imgs/fundo_textura1.gif">
              
                  
<link href="style.css" rel="stylesheet" type="text/css">
<body background="background.gif">
<form id="form1" name="form1" method="post" action="">
<table background="imgs/fundo_textura1.gif" width="712" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="712"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">
                  <tr>
                    <td colspan="2" align="center" bgcolor="#000000"><b><font color="#FFFFFF">Zerando tabela CT</span></th>
    </tr>
    <tr>
      <th scope="row"><label>
        <input type="hidden" name="acao" value="nick"><input type="submit" class="button6" onclick ="return confirm('Voc� tem certeza que deseja, zerar a tabela CT?')" value="Zerar tabela CT"><br>
        <input name="acao2" type="hidden" id="acao2" value="deletarct" />
        <br />
        <?
	  if($_POST[acao2] == "deletarct")
	  {
	  if($_SESSION['permissao'] < 3){
echo "Voc� n�o tem permiss�o para acessar esta �rea";
exit;
}

$conn = odbc_connect($clan,$user,$pass) or die("Erro ao conectar");

$seleciona = "SELECT * FROM dbo.CT";

$sql = odbc_exec($conn,$seleciona);
odbc_do($conn,"DELETE FROM dbo.CT");

echo"<font color='red'<b>Tabela CT Foi zerada com sucesso!<br>";
}
?>
      </label></th>
    </tr>
    <tr>
                  <td colspan="2" align="center"><div align="left">
                    <p><strong>Obs: cuidado ao usar est� ferramenta.</strong>                    
                    <p>Essa ferramenta, da acesso a voc&ecirc; clicando em deletar tabela CT vai deletar todos logs de Player online no servidor, automaticamente n&atilde;o ficara nenhum se realmente deseja usar essa fun��o � recomendavel que fa�a quando n�o estiver muito player on ou quando servidor estiver OFF!<strong><br>
                    </strong>Ferramenta protegida com confirma��o de zera��o, se por acaso voc� clicar em zerar tabela ct sem querer, aparecera uma mensagem se realmente deseja fazer est� a��o basta clicar cancelar, caso deseja fazer a a��o clique em Ok, sera zerado a tabela CT da database ClanDB.<br> � Recomendavel usar esse sistema quando buga, alguma conta Exemplo player vai loga fala que est� logado, ou no painel etc..<br>PS: N�O FA�A ISSO COM SERVIDOR LIGADO, DESLIGUE O SERVIDOR PARA USAR ESSE SISTEMA CASO FOR USAR.<br> 
                    </table>
      </div></td>
    </tr>
  </table>
</form>
<form id="form2" name="form2" method="post" action="">
</form>
<? ?>    