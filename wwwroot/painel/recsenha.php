<?
include_once "config.php";
include_once "injection.php";

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
    if($_POST[action]!="signup")
    {
?>

              <form  name="form_cad" method="post" action="<?=$_SERVER[PHP_SELF]."?senha".$_SERVER[QUERY_STRING]?>" onSubmit="return verifica2()">
                <div class="youplay-input">
                   <input type="text" placeholder="Usuário" name="username" required>
                </div>
                <div class="youplay-input">
                  <input type="text" placeholder="Nome Completo" name="nome" required>
                </div>
				<div class="youplay-input">
                  <input type="text" placeholder="Chave de Segurança" name="chave" maxlength="32" required>
                </div>
                <button value="Logar" class="btn btn-default db" style="width:auto">Recuperar Senha</button>
				<input type="hidden" name="action" value="signup">
              </form><br>
			  <a href="index.php" class="btn btn-default db" style="width:auto">Sair</a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?

    }
            else
            {
//Verificando se n&atilde;o vai ter injection no script
$usuario = anti_sqli($_POST['username']);
$nome = anti_sqli($_POST['nome']);
$chave = anti_sqli($_POST['chave']);

if ( anti_sql($usuario) != 0 || anti_sql($nome) != 0 || anti_sql($chave) != 0) {
echo "<p>Erro, caracteres não permitidos foram digitados!</p>
<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=recsenha.php'>";
} else {



                    $required=array(
                    "Usuário"=>$_POST[username],
                    "Nome Completo"=>$_POST[nome],
                    "Chave de Segurança"=>$_POST[chave],
                );

                for($i=0;$i<count($required);$i++)
                {
                    list($key,$value)=each($required);

                    if(!$value)
                        echo "<p>$key é obrigatório</p>
					<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=recsenha.php'>";
                    else
                        $chkArr[]=true;
                }

                if(count($chkArr)==count($required))
                {

                    $connection = odbc_connect( $connection_string, $user, $pass );
                    //Tabela separada dos players por letras iniciais
					$query = "SELECT * FROM [accountdb].[dbo].[AllPersonalMember] WHERE [userid]='$usuario' AND [CUserName1]='$_POST[nome]' AND [chave]='$_POST[chave]'";
                    $q = odbc_exec($connection, $query);
					$qt = odbc_do($connection, $query);
					$i = 0;
					while(odbc_fetch_row($qt)) $i++;
					$Senha=odbc_result($qt,3);
					
					if($i == 0) {
					$status= "Dados Incorretos! Desculpe mas não podemos informar sua senha.
					<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=recsenha.php'>";
}
else {
$status = "Dados Corretos! Sua senha é : $Senha";}
					
                                
echo "$status <br><br><a href='index.php' class='btn btn-default db'>Entrar no painel</a>";
                            }
							
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


</html>
