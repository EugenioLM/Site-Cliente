<?
if (!$_SESSION['tempo_permitido'] AND $_SESSION["ID"] <> '') {
//Gravamos o tempo atual em uma sess�o, para compararmos depois.
$_SESSION['tempo_permitido'] = mktime(date('H:i:s'));
}

//Pegando o Tempo Atual
$agora= mktime(date('H:i:s'));

// subtraimos o tempo em que o usu�rio entrou, do tempo atual "a diferen�a � em segundos"
$segundos=(is_numeric($_SESSION['tempo_permitido']) and is_numeric($agora)) ? ($agora-$_SESSION['tempo_permitido']):false;

$tlogado = round($segundos/60,0);


//definimos os segundos que o usu�rio dever� ficar logado
define('TEMPO_LOGADO',1800);
//1800 � em segundos ou seja 30 minutos, dai voc�s colocam quanto tempo julgam necess�rio.

if($segundos > TEMPO_LOGADO) {
echo 'Tempo esgotado, efetue login novamente.';
    session_unregister("usercode");
    $_SESSION["ID"]='';
    $_SESSION["charDir"]='';
    $_SESSION["charNum"]='';
    $_SESSION["charID"]='';
    $_SESSION["charName"]='';
    $_SESSION["charLevel"]='';
    $_SESSION["charClass"]='';
    $_SESSION['tempo_permitido']='';
    header("location: index.php");
}

?>