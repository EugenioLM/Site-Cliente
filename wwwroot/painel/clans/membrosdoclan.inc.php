<? if (DexteR!=1) exit;

include_once "injection.php";
include_once "incluir/configura.php";

//Verificando se ele é lider de Clan

$nomedochar = $_SESSION["ID"];
$connection = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [ClanDb].[dbo].[CL]  WHERE UserID = '$nomedochar' ";
$qLider = odbc_exec($connection, $query);
$qtLider = odbc_do($connection, $query);

$i = 0;
while(odbc_fetch_row($qtLider)){
//ClanName
$nomeclan=odbc_result($qtLider,2);
//Note
$fraseclan=odbc_result($qtLider,3);
//UserID
$idlider=odbc_result($qtLider,5);
//ClanZang
$nomelider=odbc_result($qtLider,6);
//MemCnt
$numeroMembros=odbc_result($qtLider,8);
//MIconCnt
$numeroclan=odbc_result($qtLider,9);
//RegiDate
$dataclan=odbc_result($qtLider,10);

$dataclan = substr($dataclan, 0, 10);
$explode = explode("-", $dataclan);
$dataclan = "$explode[2]/$explode[1]/$explode[0]";


$i++;
if($i==0) {

echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";

} else {

//Kickando os Players do Clan
if($_POST['acao']=="kickar") {

$connection = odbc_connect( $connection_string, $user, $pass );
$var = $_POST["nomes"];
for($i = 0; $i < count($var); $i++){
$sql = ("DELETE FROM [ClanDB].[dbo].[UL] WHERE ChName = '$var[$i]'");
//Diminui membros da tabela do clan
$numeroMembros = $numeroMembros-1;
$sql2 = ("UPDATE [ClanDB].[dbo].[CL] SET [MemCnt] = '$numeroMembros'  WHERE ClanName = '$nomeclan'");
$kick = odbc_exec($connection, $sql);
$atualizar = odbc_exec($connection, $sql2);
echo "<center><br>Player $var[$i] Kickado do Clan <br></center>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=index.php?sess=membros'>";
}
$numero_de_players_kikados = count($var);
echo "Total: ".$numero_de_players_kikados." players kikados do servidor.";
}else{

?>
<div class="row">
<form name="form1" method="post" action="index.php?sess=membros&">
<div class="col-md-3">
<div class="form-group">
<label>Clan</label><br>
<img src="http://<? echo $ipdoservidor;?>/BrnxContent/<? echo $numeroclan; ?>.bmp" width="32" height="32"> <? echo $nomeclan; ?>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Lider </label>											
<input type="text" size="15" maxlength="15" name="nick" disabled value="<? echo $nomelider; ?>" class="form-control">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Criado dia </label>											
<input type="text" size="15" maxlength="15" name="nick" disabled value="<? echo $dataclan; ?>" class="form-control">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Membros </label>											
<input type="text" size="15" maxlength="15" name="nick" disabled value="<? echo $numeroMembros; ?>" class="form-control">
</div>
</div>
</div>

<?
$connection = odbc_connect( $connection_string, $user, $pass );
$query_member = "SELECT * FROM [ClanDb].[dbo].[UL]  WHERE ClanName = '$nomeclan' and ChName <> '$nomelider' order by JoinDate ASC";
$qtmembera = odbc_do($connection, $query_member);
while($arr = odbc_fetch_array($qtmembera)){
	$membros = $arr["ChName"];
}
	if($numeroMembros == 0 ){ // Se nao tem nenhum membro, muda o valor pra -1, pra ser tratado no switch depois.
		$online = "-1";
	}else{
		// Checando users
		$query = "SELECT * FROM [ClanDB].[dbo].[CT] WHERE [ClanName] = '$nomeclan' AND [ChName] = '$membros' ";
		$go = odbc_do($connection,$query);
		$online = odbc_num_rows($go); // Numero de Usuarios do clan online
	}
		switch($online)
		{
			case "0":
				$online = "Nenhum Player do clan esta logado no server.";
			break;
			case "-1":
				$online = "Você não tem membros no seu clan";
			break;
		}
	?>
	<br>
      <table class ="ui table table-striped table-bordered" style="border: 2px solid #b5a47e;background: 0 0;transform: skew(-7deg); padding: 10px 30px;">
        <tr>
          <td ><b>Nick</b></td>
          <td align="center"><b>Classe</b></td>
          <td align="center"><b>Level</b></td>
          <td align="center"><b>Data inclusão</b></td>
          <td align="center"><b>Status</b></td>
          <td align="center"><b>Kickar</b></td>
        </tr>
<?
$connection = odbc_connect( $connection_string, $user, $pass );
$query_member = "SELECT * FROM [ClanDb].[dbo].[UL]  WHERE ClanName = '$nomeclan' and ChName <> '$nomelider' order by JoinDate ASC";
$qmember = odbc_exec($connection, $query_member);
$qtmember = odbc_do($connection, $query_member);


while(odbc_fetch_row($qtmember)){
$charmember=odbc_result($qtmember,4);
$classemember=odbc_result($qtmember,5);
$levelmember=odbc_result($qtmember,6);
$invitemember=odbc_result($qtmember,9);


$invitemember = substr($invitemember, 0, 10);
$conv = explode("-", $invitemember);
$invitemember = "$conv[2]/$conv[1]/$conv[0]";

//Checar se eles estao online ou offline
$query_online = "SELECT * FROM [ClanDb].[dbo].[CT] WHERE ChName = '$charmember'";
$membon = odbc_do($connection, $query_online);
$estaon = 0;
while(odbc_fetch_row($membon)) $estaon++;

?>
        <tr>
        <td><? echo $charmember; ?></td>
          <td align="center""><img src="imgs/0<? echo $classemember; ?>.png" width="29" height="26" border="0"></td>
          <td align="center"><? echo $levelmember; ?></td>
          <td align="center"><? echo $invitemember; ?></td>
          <td align="center"><? if($estaon == 0) { echo "<img src='imgs/off_member.gif' >";} else { echo "<img src='imgs/on_member.gif' >";} ?></td>
          <td align="center">Sim <input name="nomes[]" type="checkbox" id="nomes[]" value="<? echo $charmember; ?>">
        </tr>
<? } ?>
      </table><br>
      <p>&nbsp;</p>
      <center><input type="hidden" name="acao" value="kickar">
	  <button class="btn btn-default db" type="submit" style="max-width:180px">Alterar Clan</button>
	  <input type="hidden" name="action" value="Alterar Clan"></center><br>
      </form>
      <p>&nbsp;</p>
    </td>
  </tr>
</table>
<?
}}}
?>