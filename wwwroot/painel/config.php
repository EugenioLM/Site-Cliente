<?
define("DexteR","1");

$ipdoservidor="51.222.99.152";
// NOME DO SERVIDOR
$nomedoserver="Teste PT";

// PRISTON TALE SERVER DIRETORIO
$rootDir = "C:/ServidorrPT/";
$BLESS = "C:\ServidorrPT/BlessCastle.dat";
$ClanContent = "ClanContent";

// PRISTON TALE MÚLTIPLAS DATASERVER 

$dirUserData = $rootDir."DataServer/userdata/";
$dirUserInfo = $rootDir."DataServer/userinfo/";
$dirUserDelete = $rootDir."DataServer/deleted/";

include_once "class.func.php";
$func=new func;

// Configuração SQL!!
$host = 'SERVER\SQLEXPRESS'; //Sua instancia do SQL
$user = 'sa'; //Seu usuário do SQL; Normalmente é SA
$pass = 'm@2409'; //Sua senha do SQL

$connection_string = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=accountdb';
$sod = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=Sod2db';
$clan = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=ClanDB';
$rPTDB = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=rPTDB';
$itemlog = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=ItemLogDB';
$userdb = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=UserDB';
?>
