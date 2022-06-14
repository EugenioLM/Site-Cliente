<?if (DexteR!=1) exit;?>
<?
$username=$_SESSION["ID"];
$pasta = $func->numDir($username);
//Pasta de entrega
$pasta_entrega = $rootDir."PostBox/$pasta/$username.dat";
?>
<h4 class="title text-left"><span class="fa fa-angle-right"></span> Pedidos de Suporte</h4><hr />
      <table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#FFCC00">
      <tr>
        <td width="33%"><b>Suporte</td>
        <td width="33%"><b>Data</td>
        <td width="33%"><b>Status</td>
      </tr>
<?
$query = "SELECT * FROM [Dexter].[dbo].[Suporte] WHERE [idplayer]='$username' ORDER By data DESC";
$q = odbc_exec($connection, $query);

while($suporte = odbc_fetch_array($q)){
$idsuporte = $suporte['idsuporte'];
$data = $suporte['data'];

$bg1="#E1E1E1";
$bg2="#BCBCBC";

$data = substr($data, 0, 10);
$conv = explode("-", $data);
$data = "$conv[2]/$conv[1]/$conv[0]";


$assunto = $suporte['assunto'];
$stats = $suporte['stats'];

if ($stats == 1) { $textostats = "Recebido"; $iconsup = "suporte_recebido.png"; } 
if ($stats == 2) { $textostats = "Em Analise"; $iconsup = "suporte_analise.png"; } 
if ($stats == 3) { $textostats = "Concluído"; $iconsup = "suporte_ok.png"; } 
if ($stats == 4) { $textostats = "Negado"; $iconsup = "suporte_no.png"; } 

$cor = ($i % 2) ? $bg1 : $bg2;
$i++;


?>
      <tr>
        <td width="33%"><a href='index.php?sess=supacompanha&suporte=<?=$idsuporte?>'><? echo $assunto; ?></a></td>
        <td width="33%"><? echo $data; ?></td>
        <td width="33%"><? echo $textostats; ?></td>
      </tr>
<?
}
?>      
    </table>

    </td>
  </tr>
</table>






