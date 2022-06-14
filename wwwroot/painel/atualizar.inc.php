<? if (DexteR!=1) exit;?>
<?
include_once "incluir/configura.php";
include_once "injection.php";

if(anti_sqli($_POST[action]!="changepw"))
{

$username=$_SESSION["ID"];

                    $connection = odbc_connect( $connection_string, $user, $pass );
                    $query = "SELECT * FROM [accountdb].[dbo].[AllPersonalMember]  WHERE [userid]='$username'";
                    $q = odbc_exec($connection, $query);
                    $qt = odbc_do($connection, $query);

                    odbc_fetch_row($qt);
                    $nome=odbc_result($qt,8);
                    $sobrenome=odbc_result($qt,9);
                    $email=odbc_result($qt,14);
                    if(!$email)
   		                 {
					     echo "";
					     }

?>
<hr>
            <form  name="form_cad" method="post" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>" onSubmit="return verifica2()">
			
			<div class="form-horizontal mt-30 mb-40">
              <div class="form-group">
                <label class="control-label col-sm-2" for="cur_password">Senha Atual:</label>
                <div class="col-sm-10">
                  <div class="youplay-input">
				  <input type="hidden" name="username" class="form-control" value="<?=$_SESSION["ID"]?>">
                    <input type="password" name="oldpwd" id="cur_password" name>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="new_password">Nova Senha:</label>
                <div class="col-sm-10">
                  <div class="youplay-input">
                    <input type="password" name="pwd1" id="new_password">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default db" style="max-width: 28%;">Trocar Senha</button>
				  <input type="hidden" name="action" value="changepw">
                </div>
              </div>
            </div>
            </form>

<?
            }
            else
            {
      
//Verificando se n&atilde;o vai ter injection no script
$senha0 = anti_sqli($_POST['oldpwd']);
$senha1 = anti_sqli($_POST['pwd1']);

if (anti_sql($senha0) != 0 || anti_sql($senha1) != 0) {
echo "<p>Erro, caracteres nao permitidos foram digitados!</p>
<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
} else {



                    $required=array(
                    "Senha Antiga"=>$_POST[oldpwd],
                    "Nova Senha"=>$_POST[pwd1],
                );

                for($i=0;$i<count($required);$i++)
                {
                    list($key,$value)=each($required);

                    if(!$value)
                        echo "
<p> - </b> $key</b> é obrigatório</p>
<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
                    else
                        $chkArr[]=true;
                }

                if(count($chkArr)==count($required))
                {

                    if($_POST[pwd1]==$_POST[pwd1])
                    {
                        $connection = odbc_connect( $connection_string, $user, $pass );
						
						$queryrpt = "SELECT * FROM [accountdb].[dbo].[AllPersonalMember] WHERE [userid]='$_SESSION[ID]'";
                        $qrpt = odbc_exec($connection, $queryrpt);

                        $qtrpt = odbc_do($connection, $queryrpt);
                        $irpt = 0;
                        while(odbc_fetch_row($qtrpt)) $irpt++;

                        if($irpt>0)
                        {

                        $usernameP=($_SESSION["ID"]==$_POST[username])?$_SESSION["ID"]:$_POST[username];

                        $query = "SELECT * FROM [accountdb].[dbo].[".( strtoupper($usernameP[0]) ) ."GameUser] WHERE [userid]='$usernameP' AND [Passwd]='$_POST[oldpwd]'";
                        $q = odbc_exec($connection, $query);

                        $qt = odbc_do($connection, $query);
                        $i = 0;
                        while(odbc_fetch_row($qt)) $i++;

                        if($i>0)
                        {

                            if(!$func->is_valid_string($_POST[pwd1]))
                            {

                   	$nome = $_POST[nome];
                    $sobrenome = $_POST[sobrenome];
                    $email = $_POST[email];



                    //Tabela separada dos players por letras iniciais
					$query = "UPDATE [accountdb].[dbo].[".( strtoupper($usernameP[0]) ) ."GameUser] SET [Passwd]='$_POST[pwd1]' WHERE [userid]='$usernameP' AND [Passwd]='$_POST[oldpwd]'";
                    $q = odbc_exec($connection, $query);

					//Tabela All User
                    $query2 = "UPDATE [accountdb].[dbo].[AllGameUser] SET [Passwd]='$_POST[pwd1]' WHERE [userid]='$usernameP' AND [Passwd]='$_POST[oldpwd]'";
					 $q2 = odbc_exec($connection, $query2);
					//Tabela All Peronagem

                    $query3 = "UPDATE [accountdb].[dbo].[AllPersonalMember] SET [Passwd]='$_POST[pwd1]' WHERE [userid]='$usernameP' AND [Passwd]='$_POST[oldpwd]'";
					$q3 = odbc_exec($connection, $query3);



							     if ($q && $q2 && $q3)
                                {
echo "<p>Todos os dados foram atualizados com sucesso!</p>
<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
                                //Apagando arquivo da chave
                                }
                            }
                            else
                            {
                                    echo "<p>Tente Novamente!</p>
									<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
                            }
							
					   	}
                        else
                        {
									echo "<p>Senha Antiga está incorreta!</p>
									<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
							}

                     	}
                        else
                        {
                           			 echo "<p>Senha Antiga está incorreta!</p>
									 <meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
                             }
							 
						}
                    	else
                   		{
                       				 echo "<p>Tente Novamente!</p>
									 <meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";

                    }

                }

                echo "";
            }

			}

 
?>