<?
ob_start('ob_gzhandler');
include_once "config.php";
include_once "injection.php";
{
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teste PT</title>

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


<body>

  <!-- Main Content -->
  <section class="content-wrap full youplay-login">

    <!-- Banner -->
    <div class="youplay-banner banner-top">
      <div class="image"></div>

      <div class="info">
        <div>
          <div class="container align-center">
            <div class="youplay-form"  style="max-width: 500px;">
              <h1> Teste PT</h1>
<?
    if($_POST[action]!="signup")
    {
?>
             <form name="form_cad" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>" method="post" enctype="multipart/form-data" onSubmit="disabledBttn(this);return verifica()">
                <div class="youplay-input">
                  <input type="text" placeholder="Usuário" name="username" maxlength="10" required>
                </div>
                <div class="youplay-input">
                  <input type="password" placeholder="Senha" name="password" maxlength="10" required>
                </div>
				<div class="youplay-input">
                  <input type="text" placeholder="Nome Completo" name="nome" required>
                </div>
				<div class="youplay-input">
                  <input type="text" placeholder="E-mail" name="email" maxlength="100" required>
                </div>
				<input type="checkbox" id="regras" required> Sim, eu aceito as <a href="#">Regras de Jogo</a><br><br>
                
				<button class="btn btn-default db" value="Logar">Cadastrar</button>
				<input type="hidden" name="action" value="signup">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Banner -->
<?
    }
    else
    {

//Verificando se n&atilde;o vai ter injection no script

$login = anti_sqli(trim($_POST['username']));
$senha = anti_sqli(trim($_POST['password']));
$nome = anti_sqli(trim($_POST['nome']));
$sobrenome = anti_sqli(trim($_POST['sobrenome']));
$email = anti_sqli(trim($_POST['email']));
$regras = anti_sqli(trim($_POST['regras']));

if (anti_sql($login) != 0 || anti_sql($senha) != 0 || anti_sql($nome) != 0 || anti_sql($chave) != 0 || anti_sql($email) != 0) {
echo"Erro! Caracteres não permitidos foram digitados! <br> Não use UNDERLINE ( _ ) no Email ou em outro campo
<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=cadastrar.php'>";
} else {

        $required=array(
            "Login"=>$_POST[username],
            "Senha do Jogo"=>$_POST[password],
			"E-mail"=>$_POST[email],
			"Nome"=>$_POST[nome],
        );



        for($i=0;$i<count($required);$i++)
        {
            list($key,$value)=each($required);

            if(!$value)
                echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=cadastrar.php'>";
            else
                $chkArr[]=true;
        }

        if(count($chkArr)==count($required))
        {

            $connection = odbc_connect( $connection_string, $user, $pass );

            if(!$func->$_POST[username] && !$func->$_POST[password])
            {

                $usernameP=anti_sqli($_POST[username]);
                $query = "SELECT * FROM [accountdb].[dbo].[".( strtoupper($usernameP[0]) ) ."GameUser] WHERE [userid]='$usernameP'";
                $q = odbc_exec($connection, $query);

                $qt = odbc_do($connection, $query);
                $i = 0;
                while(odbc_fetch_row($qt)) $i++;

                if($i>0)
                    echo"Erro! O Login <b>$_POST[username]</b> Já existe registrado
<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=cadastrar.php'>";
                else
                {
				$ipnob = $_SERVER['REMOTE_ADDR'];

$ini = 0;
$executando_email = odbc_do($connection,$tabela_ip) or die (odbc_error());
if($ini>0){
echo 'Erro! Olá <strong>'.$nome.' , você já se registro em nosso Banco de Dados hoje.
<meta HTTP-EQUIV="Refresh" CONTENT="3;URL=cadastrar.php">';
}else{
	
	

$email = anti_sqli($_POST['email']);

$tabela_email = "SELECT * FROM [accountdb].[dbo].[ALLPersonalMember] WHERE [email]='$email'";
$ini = 0;
$executando_email = odbc_do($connection,$tabela_email) or die (odbc_error());
while(odbc_fetch_row($executando_email)) $ini++;
if($ini>0){
echo'Erro! O Email  <b>'.$email.'</b> Já existe registrado em nosso Banco de Dados.
</div>
<meta HTTP-EQUIV="Refresh" CONTENT="3;URL=cadastrar.php">';
}else{



                    $datahoje = date("d-m-Y H:i:s");

                    $query = "INSERT INTO [accountdb].[dbo].[".( strtoupper($usernameP[0]) ) ."GameUser] ([userid],[Passwd],[GPCode],[RegistDay],[DisuseDay],[inuse],[Grade],[EventChk],[SelectChk],[BlockChk],[SpecialChk],[Credit],[DelChk],[Channel]) values('" . $_POST[username] . "','" . $_POST[password] . "','PTP-RUD001','$datahoje','12-12-2050','0','U','0','0','0','0','0','0','" . $_SERVER['REMOTE_IP'] . "')";
                    $query2 = "INSERT INTO [accountdb].[dbo].[AllGameUser] ([userid],[Passwd],[GPCode],[RegistDay],[DisuseDay],[inuse],[Grade],[EventChk],[SelectChk],[BlockChk],[SpecialChk],[Credit],[DelChk],[Channel]) values('" . $_POST[username] . "','" . $_POST[password] . "','PTP-RUD001','$datahoje','12-12-2050','0','U','0','0','0','0','0','0','" . $_SERVER['REMOTE_IP'] . "')";

                   //Cadastrando Dados do user
                    $login = stripslashes($_POST['username']);
                    $pw = stripslashes($_POST['pw']);
                    $email = stripslashes($_POST['email']);
                    $nome = stripslashes($_POST['nome']);
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $query3 = "INSERT INTO [accountdb].[dbo].[AllPersonalMember] ([PMNo],[Userid],[Passwd],[senhapainel],[CUserName1],[Age],[Email],[RegistDay],[Pais]) VALUES ('0','" . $_POST[username] . "','" . $_POST[password] . "','" . $_POST[password] . "','$nome','0','$email','$datahoje','BR')";

                    //$query4 = "INSERT INTO [PAINEL_NET].[dbo].[Usuario] ([Nome],[Email],[Login],[IdPermissao],[Coins],[Timer],[DataCadastro],[Status],[Codigo]) VALUES ('$nome','$email','$login','1','0','0','$datahoje','1','1')";

                    $q = odbc_exec($connection, $query);
                    $q2 = odbc_exec($connection, $query2);
                    $q3 = odbc_exec($connection, $query3);
                    $q4 = odbc_exec($connection, $query4);

                    if ($q && $q2 && $q3 && $q4)


echo"Dados Cadastrados com sucesso!<br> ID: $login <br> Nome: $nome <br> Email: $email <br> Chave: $chave<br><br>
<a href='index.php' class='btn btn-default db'>Entrar no Painel</a>";

              } }
 		}
            }else{
		echo '';
		}
		}
			else
                echo"Erro!Tente Novamente.
<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=cadastrar.php'>";

        }
       echo "";
    } }

?> 
<?
exit;
ob_end_flush();
?>
