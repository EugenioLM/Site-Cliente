<? if (DexteR!=1) exit;?>
<?
include_once "injection.php";
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
$i++;
if($i==0) {

echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";

} else {

    if($_POST['acao']=="")
    {
?><br>
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
<br>
    </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><b>Frase atual do seu Clan:</b></td>
      </tr>
      <tr>
        <td><form action="index.php?sess=admclan" method="post" name="form1" id="form1">
          <label>
            <input name="frase" type="text" id="frase" value="<? echo $fraseclan; ?>" disabled="disabled" size="50" maxlength="100" />
          </label>
          <label></label>
        </form></td>
      </tr>
      </table>
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><b>Mudar frase do seu clan:</b></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="index.php?sess=admclan">
            <label>
            <input name="frase" type="text" id="frase" size="50" maxlength="100">
            </label>
			<br>
			<button class="btn btn-default db" type="submit" style="max-width:200px;margin-top:10px;">Mudar</button>
			<input type="hidden" name="action" value="Mudar"></center><br>
        </form></td>
      </tr>
    </table>
    <br><br>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><b>Mudar Imagem do Clan:</b></td>
      </tr>
      <tr>
        <td height="105"><form action="index.php?sess=admclan" method="post"  enctype="multipart/form-data">
 <center><input type="file" name="tag"><br>
 <button class="btn btn-default db" type="submit" style="max-width:200px;margin-top:10px;">Mudar</button>
 <input type="hidden" name="acao" id="acao" value="Enviar">
        <br><br>
        <p>OBS: Enviar imagem no tamanho 32x32 Formato BMP</p>
        </form>
      </tr>
    </table></td>
  </tr>
</table>
<?
}}
    if($_POST['acao']=="Mudar")
	{
$novafrase = $_POST[frase];

if (anti_sql($novafrase) != 0) {
echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?sess=negado'>";
} else {


				//Mudando a Frase do Clan
				$query = "UPDATE [ClanDb].[dbo].[CL] SET [Note]='$novafrase' WHERE [UserID]='$nomedochar'";
                                $q = odbc_exec($connection, $query);
                                if($q)
                                {
								echo "<br>Frase do Clan Atualizada!
";
								echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?sess=admclan'>";
								}


		}
    }

//Começa aqui quando der Upload de imagem
    if($_POST['acao']=="Enviar")
	{

 $erro = $config = array();

// Prepara a variável do arquivo
$arquivo = isset($_FILES["tag"]) ? $_FILES["tag"] : FALSE;

// Tamanho máximo do arquivo (em bytes)
$config["tamanho"] = 4608;
// Largura máxima (pixels)
$config["largura"] = 32;
// Altura máxima (pixels)
$config["altura"]  = 32;

// Formulário postado... executa as ações
if($arquivo)
{
    // Verifica se o mime-type do arquivo é de imagem
    if(!eregi("^image\/(bmp)$", $arquivo["type"]))
    {
        $erro[] = "Arquivo em formato inválido! A imagem deve ser jem BMP. Envie outro arquivo";
    }
    else
    {
        // Verifica tamanho do arquivo
        if($arquivo["size"] > $config["tamanho"])
        {
            $erro[] = "Arquivo em tamanho muito grande!
		A imagem deve ser de no máximo " . $config["tamanho"] . " bytes.
		Envie outro arquivo";
        }

        // Para verificar as dimensões da imagem
        $tamanhos = getimagesize($arquivo["tag_name"]);

        // Verifica largura
        if($tamanhos[0] > $config["largura"])
        {
            $erro[] = "Largura da imagem não deve
				ultrapassar " . $config["largura"] . " pixels";
        }

        // Verifica altura
        if($tamanhos[1] > $config["altura"])
        {
            $erro[] = "Altura da imagem não deve
				ultrapassar " . $config["altura"] . " pixels";
        }
    }

    // Imprime as mensagens de erro
    if(sizeof($erro))
    {
        foreach($erro as $err)
        {
            echo " - " . $err . "<BR>";
        }

       //Volta para a page de adm
       	echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?sess=admclan'>";
    }

    // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
    else
    {
        // Pega extensão do arquivo
        preg_match("/\.(bmp){1}$/i", $arquivo["name"], $ext);

        // Gera um nome único para a imagem
        $imagem_nome = $numeroclan . "." . $ext[1];

        // Caminho de onde a imagem ficará
        $imagem_dir = "C:/Inetpub/wwwroot/ClanContent/" . $imagem_nome;

        //Verifica se arquivo já existe e deleta ele
        $caminho ="C:/Inetpub/wwwroot/ClanContent/";
        if(file_exists("$caminho/$numeroclan")) {
        unlink($caminho.'/'.$numeroclan);
        }

        // Faz o upload da imagem
        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);


        echo "<br>Sua Tag foi enviada com sucesso!";
        echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=index.php?sess=admclan'>";
    }
}
}
///Acaba aqui o Upload
}
?>

