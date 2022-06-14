<?
if (RadixPK!=1) exit;

include_once "injection.php";

$nomedochar = $_SESSION["charName"];
$connection = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [ClanDb].[dbo].[CL]  WHERE ClanZang = '$nomedochar'";
$ini = 0;
$query = odbc_do($connection,$query) or die (odbc_error());
while(odbc_fetch_row($query)) $ini++;
if($ini>0){
echo '<table width="100%" border="0" cellpadding="6" cellspacing="0"><img src="imagens/alerta.gif" width="37" align="left" height="36"><font arial,="" helvetica,="" sans-serif="" face="Verdana," size="2">Você é lider de um clan portanto não pode sair do seu clan por aqui, va até a area de adminstração de clans e delegue algum membro de seu clan, caso não quiser repassar o clan você pode <strong><font color="#990000">Excluir</font></strong>
o clan.<br> </font></div></td></tr></tbody></table>';
}else{

//Verificando se ele é lider de Clan
$nomedochar = $_SESSION["ID"];
$connection = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [ClanDb].[dbo].[UL]  WHERE UserID = '$nomedochar' ";
$qLider = odbc_exec($connection, $query);
$qtLider = odbc_do($connection, $query);

$nomeclan=odbc_result($qtLider,7);

$connection = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [ClanDb].[dbo].[CL] WHERE ClanName = '".$_SESSION["clan"]."'";
$q = odbc_exec($connection, $query);
$Cmember = odbc_fetch_array($q);
$numeroMembros = $Cmember['MemCnt'];

$kick = odbc_exec($connection, "DELETE FROM [ClanDB].[dbo].[UL] WHERE ChName = '".$_SESSION["charName"]."' ");
$atualizar = ("DELETE FROM [ClanDB].[dbo].[UL] WHERE ChName = '".$_SESSION["charName"]."' ");
$numeroMembros = $numeroMembros-1;
$atualizar = odbc_exec($connection, "UPDATE [ClanDB].[dbo].[CL] SET [MemCnt] = '$numeroMembros'  WHERE ClanName = '".$_SESSION['clan']."'");

if($kick && $atualizar){
echo "<center>Você saiu do clan ".$nomeclan." com sucesso <meta HTTP-EQUIV='Refresh' CONTENT='5;URL=index.php?sess=char'>";
unset($_SESSION['clan']);
}else{
echo "Falha";
}
}
?>