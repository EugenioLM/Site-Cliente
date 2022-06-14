<?php
/*----------------------------------------------------------------------
Painel Player Versão 0.1
Desenvolvidor Por: Mak (sirmakloud@gmail.com)
Editado Por: Jiraya (richard.cva21@hotmail.com(
----------------------------------------------------------------------*/
$nomechar = $_POST["newchar"];
$dia = date("m");
$mes = date("d");
$ano = date("Y");
$id = $_SESSION["ID"];
$dados = "$nomechar;$dia;$mes;$ano;$id\r\n";

//nome do arquivo texto:
$arq = "controlechars.txt";

$abre = fopen($arq, "r");
$total = @fread($abre, filesize($arq));
fclose($abre);

$abre = fopen($arq, "w");
$total = "$dados  $total";
$salva = fwrite($abre, $total);

//fecha o arquivo
fclose($abre);
?>

