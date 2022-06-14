<?if (DexteR!=1) exit;?>
<?
header("Content-type:text/html;charset=UTF-8");
?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$username=$_SESSION["ID"];
$pasta = $func->numDir($username);
//Pasta de entrega
$pasta_entrega = $rootDir."PostBox/$pasta/$username.dat";
?>

<table width="100%" border="0" align="center" cellpadding="6" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><h4 class="title text-left"><span class="fa fa-angle-right"></span> Suporte</h4></td>
      </tr>
    </table>
    <p align="center">
<?

if ($_POST["suporte"]) {
$idsuporte = $_POST["suporte"];
} else {
$idsuporte = $_GET["suporte"];
}

if (anti_sqlSuporte($idsuporte) != 0) {
echo "<center><b><p><br><p>O número de suporte informado não é válido!<p><br><p></b></center>";
} else {


if(is_numeric($idsuporte)) {

$connection = odbc_connect( $connection_string, $user, $pass );

$querys = "SELECT * FROM [Dexter].[dbo].[Suporte] WHERE [idsuporte]='$idsuporte' AND [idplayer]='$username'";
$qs = odbc_exec($connection, $querys);
$dados = odbc_fetch_array($qs);
$idplayerS = $dados['idplayer'];
$charS = $dados['char'];
$resumoS = $dados['resumo'];
$assuntoS = $dados['assunto'];
$dataS = $dados['data'];
$dataS = substr($dataS, 0, 10);
$convS = explode("-", $dataS);
$dataS = "$convS[2]/$convS[1]/$convS[0]";

$dia1S = $dados['dia1'];
$mes1S = $dados['mes1'];
$ano1S = $dados['ano1'];
$hora1S = $dados['hora1'];
$datacompleta1 = "$dia1S/$mes1S/$ano1S - $hora1S";
$dia2S = $dados['dia2'];
$prejuS = $dados['preju'];
$ipS = $dados['IP'];
$UltimaRespS = trim($dados['UltimaResp']);
$statsS = $dados['stats'];
$notaS = $dados['nota'];

if (!$assuntoS) {
?>
        <strong>O suporte que tentou ver n&atilde;o faz parte de seus pedidos!</strong>
        <?
} else {

        if(!$_POST[acao])
        {
?>
      </p>
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td bgcolor="#FFCC00"><img src="imgs/setinha.gif" width="11" height="11" /> <? echo $assuntoS; ?></td>
          <td bgcolor="#FFCC00"><? echo "$dataS"; ?></td>
        </tr>
        <tr>
          <td bgcolor="#E1E1E1"><strong>Data do ocorrido</strong>:
            <?=$datacompleta1;?></td>
          <td bgcolor="#E1E1E1"><strong>IP: </strong>
            <?=$ipS;?></td>
        </tr>


        <tr>
          <td colspan="2" bgcolor="#E1E1E1"><strong>Resumo do Ocorrido:</strong><?=$resumoS;?></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#E1E1E1"><strong>Prejuizos:</strong>
              <?=$prejuS;?></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#E1E1E1"><form id="form1" name="form1" method="post" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>">
              <label> </label>
              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td bgcolor="#E1E1E1"><table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#FFCC00">
                      <?


$connection = odbc_connect( $connection_string, $user, $pass );
$queryLI = "SELECT * FROM [Dexter].[dbo].[SuporteResp] WHERE [idsuporte]='$idsuporte' ORDER BY [id] ASC";
$qLI = odbc_exec($connection, $queryLI);

$bg1="#FFEC9F";
$bg2="#99BBDD";

while($suporteX = odbc_fetch_array($qLI)){
$dataLI = $suporteX['data'];
$dataLI = substr($dataLI, 0, 10);
$convLI = explode("-", $dataLI);
$dataLI = "$convLI[2]/$convLI[1]/$convLI[0]";
$respostaLI = $suporteX['resposta'];
$GMLI = $suporteX['gm'];
$IPLI = $suporteX['IP'];
$horaLI = $suporteX['hora'];

$cor = ($i % 2) ? $bg1 : $bg2;
$i++;
?>
                      <tr>
                        <td width="50%" bgcolor="<?=$cor;?>"><? echo $GMLI;?></td>
                        <td width="23%" bgcolor="<?=$cor;?>"><? echo "$dataLI - $horaLI"; ?></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="<?=$cor;?>"><div align="justify"><? echo nl2br($respostaLI); ?></div></td>
                      </tr>
                      <?
}
?>
                  </table></td>
                </tr>
<?
if ($statsS == 3 AND !$notaS ) {
?>
                <tr>
                  <td bgcolor="#E1E1E1"><img src="imgs/setinha.gif" width="11" height="11" /> <strong>Avalie o atendimento: </strong></td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#E1E1E1"><font size="1">
                    <label>
                    <input type="radio" name="nota" id="radio" value="5">
                    </label>
                  Excelente
                  <input type="radio" name="nota" id="radio2" value="4">
                  Ótimo
                  <input type="radio" name="nota" id="radio3" value="3">
                  Bom
                  <input type="radio" name="nota" id="radio4" value="2">
                  Regular
                  <input type="radio" name="nota" id="radio5" value="1">
                  Ruim
                  <input type="radio" name="nota" id="radio6" value="0">
                  Péssimo</font></td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#FFFFFF"><input name="idsuporte" type="hidden" id="idsuporte" value="<?=$idsuporte; ?>" />
                    <input type="hidden" name="acao" id="acao" value="Avaliar" />
                    <input type="submit" name="acao" id="acao" value="Avaliar" />
                  </td>
                </tr>
<? }
 if ($statsS <> 3 AND $statsS <> 4) {
 ?>
                <tr>
                  <td align="center" bgcolor="#E1E1E1"><label>
                    <textarea name="resposta" id="resposta" cols="45" rows="5"></textarea>
                    <br>
                    <input name="idsuporte" type="hidden" id="idsuporte" value="<?=$idsuporte; ?>" />
                    <input type="submit" name="acao" id="acao" value="Responder" class="btn btn-primary" />
                  </label></td>
                </tr>

<? } ?>
              </table>
          </form></td>
        </tr>
      </table>
    <?
} else {
//Pegando Caso

$idsuporte = $_POST[idsuporte];
$resposta = $_POST[resposta];
$resposta = addslashes($resposta);
$nota = $_POST[nota];

$resposta = trim(str_replace("\r\n"," ",$resposta));

$resposta = strip_tags($resposta);
$idsuporte = strip_tags($idsuporte);
$nota = strip_tags($nota);

$data = date("m-d-Y");
$hora=date("H:i:s");
$IP = $_SERVER["REMOTE_ADDR"];

if($_POST[acao]=="Avaliar") {

$query = "UPDATE [Dexter].[dbo].[Suporte] SET [nota]='$nota' WHERE [idsuporte]='$idsuporte'";
$q = odbc_exec($connection, $query);

echo "<p><br><p><center><b>Sua Avaliação foi realizada com sucesso!<p><br><p>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=?sess=supacompanha&suporte=$idsuporte'>";
}

if ($resposta) {

if (anti_sqlSuporte($idsuporte) != 0 || anti_sqlSuporte($resposta) != 0) {
echo "Você está utilizando algum caracter não autorizado pro nosso sistema, preencha novamente!";
} else {


if ($UltimaRespS == 'GM') {

echo "<div class='alert alert-warning text-center'>
<span><b> Aguarde mensagem da Equipe de Suporte <br>para enviar nova mensagem deste seu pedido!</span>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=?sess=supacompanha&suporte=$idsuporte'>";
} else {

$query = "UPDATE [Dexter].[dbo].[Suporte]  SET [UltimaResp]='GM' WHERE [idsuporte]='$idsuporte'";
$q = odbc_exec($connection, $query);

$query2 = "INSERT INTO [Dexter].[dbo].[SuporteResp] ([idsuporte],[resposta],[data],[hora],[IP]) VALUES ('$idsuporte','$resposta','$data','$hora','$IP')";
		$q2 = odbc_exec($connection, $query2);

echo "<div class='alert alert-success text-center'>
<span><b> Sua Mensagem foi enviada para o Suporte!</span>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=?sess=supacompanha&suporte=$idsuporte'>";

}
}
} else {

if($_POST[acao]<>"Avaliar") {
echo "<div class='alert alert-warning text-center'>
<span><b> Você esté tentando enviar uma mensagem mas não escreveu nada!</span>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=?sess=supacompanha&suporte=$idsuporte'>";
}
}
}
}

} else {
echo "<div class='alert alert-danger text-center'>
<span><b> O número de suporte informado não é válido!</span>
";
}
}
?>
</td>
  </tr>
</table>





