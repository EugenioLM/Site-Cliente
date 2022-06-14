<?
/*----------------------------------------------------------------------
Painel Player Versão 1.0
Desenvolvidor Por: DexteR (lecosb@gmail.com)
----------------------------------------------------------------------*/
ob_start('ob_gzhandler');

session_start();

header('p3p: CP="CAO PSA OUR"');
//$erro=error_reporting(0);
include_once "config.php";
include_once "injection.php";

include_once "verifica_tempo.php";



if($_GET['sess']=="logout")
{
 session_destroy();
   /* $_SESSION["charDir"]='';
    $_SESSION["charNum"]='';
    $_SESSION["charID"]='';
    $_SESSION["charName"]='';
    $_SESSION["charLevel"]='';
    $_SESSION["charClass"]='';*/
    header("location: index.php");
}

//Segurança para o PHP

//foreach ($_GET as $key=>$getvar){ $_GET[$key] = mssql_escape($getvar); } 
//foreach ($_POST as $key=>$postvar){ $_POST[$key] = mssql_escape($postvar); } 


function escapestrings($string)
{
    //se magic_quotes não estiver ativado, escapa a string
    if (!get_magic_quotes_gpc())
    {
        return mysql_escape_string($string); // função nativa do php para escapar variáveis.
    }
    else
    {
        // caso contrario
        return $string; // retorna a variável sem necessidade de escapar duas vezes
    }
}



if(!$_SESSION["ID"])
{
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
  <!-- RTL (uncomment this to enable RTL support) -->
  <!-- <link rel="stylesheet" type="text/css" href="assets/youplay/css/youplay-rtl.css" /> -->

</head>


<body>
  
  <!-- Main Content -->
  <section class="content-wrap full youplay-login"">

    <!-- Banner -->
    <div class="youplay-banner banner-top">
      <div class="image"></div>

      <div class="info">
        <div>
          <div class="container align-center">
            <div class="youplay-form"  style="max-width: 500px;">
              <h1> Teste PT</h1>

<?
    if($_POST['action']!="Logar")
    {
	require	'gerarrand.php';
	$strRand = gerar_string_randonica();
?>
              <form method="post" class="form-horizontal" onSubmit="disabledBttn(this)" action="index.php">
                <div class="youplay-input">
                  <input type="text" name="username" placeholder="Login">
                </div>
                <div class="youplay-input">
                  <input type="password" name="password" placeholder="Password">
                </div>
                <button value="Logar" class="btn btn-default db">Login</button>
				<input type="hidden" name="action" value="Logar">
				<br><br>
				<a href="cadastrar.php" class="btn btn-default db">Cadastrar</a>
				<a href="recsenha.php" class="btn btn-default db">Recuperar Senha</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?
    }
    else
    {
        $required=array(
            "o Usuário"=>$_POST[username],
            "a Senha"=>$_POST[password],
        );

//Obtendo login e senha
$usuarioAPT = anti_sqli(escapestrings($_POST['username']));
$senhaAPT = anti_sqli(escapestrings($_POST['password']));
$usuarioAPT = trim($usuarioAPT);
$senhaAPT = trim($senhaAPT);


if (anti_sql($usuarioAPT) != 0 || anti_sql($senhaAPT) != 0 ) {
echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
} else {


        for($i=0;$i<count($required);$i++)
        {
            list($key,$value)=each($required);

            if(!$value)
                echo "<p>Erro!</strong> Você esqueceu de informar $key.</p><meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
            else
                $chkArr[]=true;
        }

        if(count($chkArr)==count($required))
        {
		
            $connection = odbc_connect( $connection_string, $user, $pass );
			
            $querysenha = "SELECT * FROM [accountdb].[dbo].[ALLPersonalMember] WHERE [Userid]='$usuarioAPT'";
            $qsenha = odbc_exec($connection, $querysenha);
            $qtsenha = odbc_do($connection, $querysenha);
            $i2 = 0;
            while(odbc_fetch_row($qtsenha)) $i2++;
            $email=odbc_result($qtsenha,1);

            if($i2>0)
            {

            $usernameP=anti_sqli($_POST[username]);
            $query = "SELECT * FROM [accountdb].[dbo].[".( strtoupper($usernameP[0]) ) ."GameUser] WHERE [userid]='$usuarioAPT' AND [Passwd]='$senhaAPT'";
            $q = odbc_exec($connection, $query);

            $qt = odbc_do($connection, $query);
            $i = 0;
            while(odbc_fetch_row($qt)) $i++;
            $email=odbc_result($qt,1);

            if($i>0)
            {

		///////////////////////////////
            
                $farr = odbc_fetch_array($q);

                $_SESSION["ID"]=$farr[userid];

      echo "<p>Dados Corretos! Aguarde.</p>
			</div>";
            }
            else
       echo "<p>Erro! Usuário ou Senha incorretos.<p>
			<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>
";

        } else {
	
	echo "<p>Erro!</strong> Usuário ou Senha incorretos.</p>
	<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
}

        echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";



    }
    //} Verifica pela GD fechamento
    }
	}


?>

  </section>
  <!-- /Main Content -->


  <!-- jQuery -->
  <script type="text/javascript" src="assets/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Hexagon Progress -->
  <script type="text/javascript" src="assets/bower_components/HexagonProgress/jquery.hexagonprogress.min.js"></script>


  <!-- Bootstrap -->
  <script type="text/javascript" src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Smooth Scroll -->
  <script type="text/javascript" src="assets/bower_components/smoothscroll-for-websites/SmoothScroll.js"></script>
  <!-- Youplay -->
  <script type="text/javascript" src="assets/youplay/js/youplay.min.js"></script>

  <!-- init youplay -->
  


</body>

<?
exit;
}
require "index2.php";
ob_end_flush();
?>

</html>
