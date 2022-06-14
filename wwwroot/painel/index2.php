<?
 if (DexteR!=1) exit;

$username=$_SESSION["ID"];
?>
<!DOCTYPE html>

<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Teste PT</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Icon -->
  <link rel="icon" type="image/png" href="icone.ico">
  <!-- Google Fonts -->

  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" />

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Owl Carousel -->
  <link rel="stylesheet" type="text/css" href="assets/bower_components/owl.carousel/dist/assets/owl.carousel.min.css" />
  <!-- Youplay -->

  <link rel="stylesheet" type="text/css" href="assets/youplay/css/youplay.min.css" />

  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="assets/css/custom.css" />
</head>
<?
$username=$_SESSION["ID"];
include'config.php';
$conecta = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [ClanDb].[dbo].[CT] WHERE [UserID]='$username'";
$executa = odbc_exec($conecta,$query);
while($busca_resulta = odbc_fetch_array($executa)){
$id_online = $busca_resulta['UserID'];
}
if($id_online == $username){
header("location: index.php?sess=logout");
}else{
}

?>
<?
$username=$_SESSION["ID"];
$conecta = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [accountdb].[dbo].[AllGameUser] WHERE [userid]='$username'";
$executa = odbc_exec($conecta,$query);
while($busca_resulta = odbc_fetch_array($executa)){
$banido = $busca_resulta['BlockChk'];
}
if($banido == "1"){
header("location: banido.php");
}else{
}
?>

<body>


  <!-- Navbar -->
  <nav class="navbar-youplay navbar navbar-default navbar-fixed-top ">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="off-canvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
		  
          <li><a href="?sess=char">Criar Personagem</a></li>
          <li class="dropdown dropdown-hover ">
            
            <div class="dropdown-menu">
              <ul role="menu">
                
				
              </ul>
            </div>
          </li>

		  <li class="dropdown dropdown-hover ">
            
            <div class="dropdown-menu">
              <ul role="menu">
                
              </ul>
            </div>
          </li>
          <li class="dropdown dropdown-hover">
            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      <?echo $username?>  <span class="caret"></span> 
                    </a>
            <div class="dropdown-menu">
              <ul role="menu">
                <li><a href="?sess=mudarsenha">Alterar Dados </a>
                </li>
                <li><a href="?sess=logout">Sair</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- /Navbar -->

  <!-- Main Content -->
  <section class="content-wrap youplay-login">

    <!-- Banner -->
    <div class="youplay-banner banner-top">
      <div class="image"></div>

      <div class="info">
        <div>
          <div class="container align-center">
            <div class="youplay-form">
			
<?
$nomedochar = $_SESSION["ID"];

//Vendo se o Player est&aacute; Banido
$connection = odbc_connect( $connection_string, $user, $pass );
$query_ban = "SELECT * FROM [accountdb].[dbo].[".( strtoupper($nomedochar[0]) ) ."GameUser] WHERE [userid]='$nomedochar'";
$q_ban = odbc_exec($connection, $query_ban);
$qt_ban = odbc_do($connection, $query_ban);
while(odbc_fetch_row($qt_ban)) {
$verbanido = odbc_fetch_array($q_ban);
$taban=$verbanido[BlockChk];
}
if ($taban == "1") {
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=banido.php'>";
}
?>
<?
$nomedochar = $_SESSION["ID"];
//$nomedochar = $_SESSION["charID"];
$connection = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [ClanDb].[dbo].[CL]  WHERE UserID = '$nomedochar' ";
$qLider = odbc_exec($connection, $query);
$qtLider = odbc_do($connection, $query);

$i = 0;
                while(odbc_fetch_row($qtLider)){
                $nomeclan=odbc_result($qtLider,2);

                 $i++;

                if($i==0) {} else {
?>
<?
}}
$CHAR=($_GET["char"])?$_GET["char"]:$_POST["char"];

if( !$CHAR )
{
	$query = "SELECT * FROM [clanDB].[dbo].[CL]";
	$go = odbc_do($connection,$query);
function AcertarLinhasODBC($conexao,$query){
	$resultado = odbc_exec($conexao,$query);
	$contador=0;
	while($temp = odbc_fetch_into($resultado, &$counter)){
		$contador++;
	}
	return $contador;
}
	$online = AcertarLinhasODBC($connection,$query);
?>
<div style="border: 2px solid #b5a47e;background: 0 0;transform: skew(-7deg); padding: 10px 30px;">
Personagens:
<?
            $qCharID=($_SESSION["charID"])?$_SESSION["charID"]:$_SESSION["ID"];
            $charInfo=$dirUserInfo . ($func->numDir($qCharID)) . "/" . $qCharID . ".dat";

            if(file_exists($charInfo) && ( filesize($charInfo)==240) )
            {
                $fRead=false;
                $fOpen = fopen($charInfo, "r");
                $fRead =fread($fOpen,filesize($charInfo));
                @fclose($fOpen);

                // list char information
                $charNameArr=array(
                    "48" => trim(substr($fRead,0x30,15),"\x00"),
                    "80" => trim(substr($fRead,0x50,15),"\x00"),
                    "112"=> trim(substr($fRead,0x70,15),"\x00"),
                    "144"=> trim(substr($fRead,0x90,15),"\x00"),
                    "176"=> trim(substr($fRead,0xb0,15),"\x00"),					
                );

                if(count($charNameArr)>0)
                {
                    foreach($charNameArr as $key=>$value)
                    {
                        $expValue=explode("\x00",$value);
                        echo "<a href=\"?char=".$expValue[0]."\">".$expValue[0]."</a>&nbsp;&nbsp;";
                    }
                }
                else
                {
                    echo "Nenhum Personagem";
                }

            }
            else
            {
                echo "Nenhum Personagem";
            }
?>             
</div>
<?
if($_SESSION["charDir"])
{
$nickchar = $_SESSION["charName"];
$query_clan = "SELECT * FROM [ClanDb].[dbo].[UL]  WHERE ChName = '$nickchar'";
$q_clan = odbc_exec($connection, $query_clan);
$clan = odbc_fetch_array($q_clan);
$nomeclan = $clan['ClanName'];
$numeroclan = $clan['MIconCnt'];

?>
<br>
<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>Classe</label><br>
<img src="imgs/<?=$_SESSION["charClass"]?>.png" width="35" height="35" border="1">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Personagem </label>											
<input type="text" size="15" maxlength="15" name="nick" disabled value="<?=$_SESSION["charName"]?>" class="form-control">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Level</label><br>
<center>
<input type="text" class="form-control"  disabled value="<?=$_SESSION["charLevel"]?>" style="max-width:60px">
</center>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<form method="post" onSubmit="disabledBttn(this)" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>&pgid=$pgid">
			<button class="btn btn-default db" type="submit" style="max-width:180px">Deletar Personagem</button>
            <input type="hidden" name="action" value="Apagar Char"></center><br>
</form>
</div>
</div>
</div>

<!-- Skill & Status -->
<div class="row">
<div class="col-md-2 col-md-offset-3">
<div class="form-group">

</div>
</div>
</div>


<? } ?>
<!--  Dados Char -->


<!-- Paginas -->
<?
$sess=(!$_GET[sess])?"home":$_GET[sess];
switch($sess)
{
    case "home":
        include_once "home.inc.php";
    break;
	
	case "char":
        include_once "char.inc.php";
    break;
	
    case "mudarsenha":
        include_once "atualizar.inc.php";
    break;
	
	 case "doar":
        include_once "doar.inc.php";
    break;
	
	

//Administra dados do Clan e exibe infos dele
    case "admclan":
        include_once "clans/admclan.inc.php";
    break;

        //Lider vê membros do clan
    case "membros":
        include_once "clans/membrosdoclan.inc.php";
    break;

}
?>

            
          </div>
        </div>
      </div>
    </div>
	</div>
    <!-- /Banner -->

  </section>
  <!-- /Main Content -->

  <!-- jQuery -->
  <script type="text/javascript" src="assets//bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Hexagon Progress -->
  <script type="text/javascript" src="assets//bower_components/HexagonProgress/jquery.hexagonprogress.min.js"></script>


  <!-- Bootstrap -->
  <script type="text/javascript" src="assets//bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Smooth Scroll -->
  <script type="text/javascript" src="assets//bower_components/smoothscroll-for-websites/SmoothScroll.js"></script>
  <!-- Youplay -->
  <script type="text/javascript" src="assets//youplay/js/youplay.min.js"></script>

  <!-- init youplay -->
<?
}
else
{

    $charDat = $dirUserData . ( $func->numDir($CHAR) ) . "/" . $CHAR . ".dat";

    if(file_exists($charDat) && ( (filesize($charDat)==16384) || (filesize($charDat)==111376) || (filesize($charDat)==220976) ) )
    {

        $fOpen = fopen($charDat, "r");
        $fRead =fread($fOpen,filesize($charDat));
        @fclose($fOpen);

        // details
        $charLevel = substr($fRead,0xc8,1);
        $charClass = substr($fRead,0xc4,1);
        $charName = trim(substr($fRead,0x10,15),"\x00");
        $charID = trim(substr($fRead,0x2c0,10),"\x00");

        if( (strtolower($charID)==strtolower($_SESSION["ID"]))  )

        {

            if($CHAR==$charName)
            {

                switch (ord($charClass))
                {
                    case 1: $class = 'Lutador'; break;
                    case 2: $class = 'Mecanico'; break;
                    case 3: $class = 'Arqueira'; break;
                    case 4: $class = 'Pike'; break;
                    case 5: $class = 'Atalanta'; break;
                    case 6: $class = 'Cavaleiro'; break;
                    case 7: $class = 'Mago'; break;
                    case 8: $class = 'Sacerdotisa'; break;
					case 9: $class = 'Assassina'; break;
					case 10: $class = 'Xama'; break;
                }

                $_SESSION["charDir"]=$charDat;
                $_SESSION["charNum"]=$func->numDir($CHAR);
                $_SESSION["charID"]=$charID;
                $_SESSION["charName"]=$charName;
                $_SESSION["charLevel"]=ord($charLevel);
                $_SESSION["charClass"]=$class;


				if ($_POST["vaibank"] == "1") {
    			header("location: index.php?sess=bank");
    			} else {
				header("location: index.php");
				}


            }
            else
            {
                $expName=explode("\x00",$charName);

                $fRead=false;
                $fOpen = fopen($charDat, "r");
                while (!feof($fOpen)) {
                @$fRead = "$fRead" . fread($fOpen, filesize($charDat) );
                }
                fclose($fOpen);

                // Fill in 00 to left character
                $addOnLeft=false;
                $leftLen=32-strlen($expName[0]);
                for($i=0;$i<$leftLen;$i++)
                {
                    $addOnLeft.=pack("h*",00);
                }
                $writeName=$expName[0].$addOnLeft;

                $sourceStr = substr($fRead, 0, 16) . $writeName . substr($fRead, 48);
                $fOpen = fopen($charDat, "wb");
                fwrite($fOpen, $sourceStr, strlen($sourceStr));
                fclose($fOpen);


                echo "CLEAR UP YOUR FILE, RE-ENTER!";
            }


        }
        else
        {
            echo "ERRO ESTE CHAR NÃO É SEU, VOCÊ ESTA SENDO REDICIONADO.!";header("Location: index.php?sess=logout");
        }


    }
    else
    {
        echo "<div class='alert alert-danger text-center' role='alert'>
Personagem CORROMPIDO!
</div>";
    }

    echo "<center><a href=index.php>VOLTAR</a>";

}

?>



</body>

</html>
