<? if (PT!=1) exit; 
if($_SESSION['permissao'] < 3){
echo "Você não tem permissão para acessar esta área";
exit;
}
?>

<?php
include_once "injection.php";
include_once "incluir/configura.php";

$hotuk = "hotuk.ini";
$file = "$rootDir$hotuk";
$post = stripslashes($_POST['hotuk']);
$fp = file_put_contents($file, $post);

if($fp){
echo "
<script>
alert(\"Hotuk editada com sucesso!\");
</script>
";
echo "<script>history.go(-1);</script>";
}else{
echo "
<script>
alert(\"Falha!\");
</script>
";
echo "<script>history.go(-1);</script>";
}
?>