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
$post = stripslashes($_POST['banned']);
$fp = file_put_contents($file, $post);

if($fp){
echo "
<script>
alert(\"Banned.ini editada com sucesso!\");
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