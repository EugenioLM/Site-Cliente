<?
define("PT","1");

/*----------------------------------------------------------------------
Painel de Adminstra��o
PESSOAS QUE CONTRIBUIRAM NO DESENVOLVIMENTO DO PAINEL DE ADMINSTRA��O.
Niik - Jeck - MecanicoGM - N�ckolas - D kin
----------------------------------------------------------------------*/

// TITULO DAS PAGINAS DO PAINEL
$version="Painel de Administra��o";

//Nome do Executavel do servidor.exe (coloque s� o nome, sem a exten��o .exe)
$Server = "server";

//Porta do servidor
$portasv = "33003";

// IP DA MAQUINA QUE O PAINEL EST� ATUALMENTE
$iphost = "51.222.99.152";

// DIRETORIO DA SERVER FILES NO HOST
$rootDir = "C:/ServidorrPT/"; 

// DIRETORIO DO PAINEL DE CONTROLE PLAYER EM PASTAS
$pastapainel = 'C:/Program Files (x86)/VertrigoServ/www/Painel/';
$extrato = "C:/Program Files (x86)/VertrigoServ/www/Painel/shop/historic/";
$creditos = "C:/Program Files (x86)/VertrigoServ/www/Painel/shop/bonusplayer/";

// DIRETORIOS DA PASTA DATASERVER
// NECESSITA TODAS AS PERMI��ES
$dirUserData = $rootDir."DataServer/userdata/";
$dirUserInfo = $rootDir."DataServer/userinfo/";
$dirUserDelete = $rootDir."DataServer/deleted/";

include_once "class.func.php";
$func=new func;

// Configura��o SQL!!
$host = 'SERVER\SQLEXPRESS'; //Sua instancia do SQL
$user = 'sa'; //Seu usu�rio do SQL; Normalmente � SA
$pass = 'm@2409'; //Sua senha do SQL

$connection_string = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=accountdb';
$sod = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=Sod2db';
$clan = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=ClanDB';
$rPTDB = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=rPTDB';
$itemlog = 'DRIVER={SQL Server};SERVER='.$host.';DATABASE=ItemLogDB';

// Configura��o SQL!!
$host2 = 'SERVER\SQLEXPRESS'; //Sua instancia do SQL
$user2 = 'sa'; //Seu usu�rio do SQL; Normalmente � SA
$pass2 = 'm@2409'; //Sua senha do SQL

$connection_string2 = 'DRIVER={SQL Server};SERVER='.$host2.';DATABASE=accountdb';

?>
