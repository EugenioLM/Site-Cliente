<!DOCTYPE html>
<html>

    <head>

        <title>Gerênciar Clan´s  </title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta name="description" content="Mint by Grozav is a flat design approach towards Admin Dashboards. Intuitive, cutting-edge, clean and easy to use and customize, as every Application UI should be. ">

        <link rel="author" href="http://grozav.com"/>

        <!-- Core CSS - Include with every page -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

        <!-- Mint Admin CSS - Include with every page -->
        <link href="css/mint-admin.css" rel="stylesheet">

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title">Administração de Clans  </h3>
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">ID:
                                        <input class="form-control" name="ID" id="ID" type="text" autofocus>
                                    </div>
                                    <div class="form-group">Senha:
                                        <input class="form-control" name="Senha" id="Senha" type="password" value="">
                                    </div>
                                    <!--<div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>-->
                                    <!-- Change this to a button or input when using this as a form -->
                                    <a onClick="AcessarPainel();" class="btn btn-lg btn-primary btn-block">Acessar</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Scripts - Include with every page -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Mint Admin Scripts - Include with every page -->
        <script src="js/mint-admin.js"></script>
        <script src="js/ajax.js" type="text/javascript"></script>
        
        <script type="text/javascript">
		function AcessarPainel()
		{	
			if(document.getElementById("ID").value=="")
			{
				alert("Por favor, informe seu Login.");
				return false;	
			}
			
			if(document.getElementById("Senha").value=="")
			{
				alert("Por favor, informe sua Senha.");
				return false;	
			}
			
			var ID = document.getElementById("ID").value;
				ID = ID.replace(".");
				ID = ID.replace("-");
				ID = ID.replace("/");
				ID = ID.replace("|");
		
			var Senha = document.getElementById("Senha").value;
				Senha = Senha.replace(".");
				Senha = Senha.replace("-");
				Senha = Senha.replace("/");
				Senha = Senha.replace("|");
			
			var SistemaShop = createXMLHTTP();
			SistemaShop.open("post", "Ajax_ConteudoGeral.asp", true);	
			SistemaShop.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			SistemaShop.onreadystatechange=function(){
			if (SistemaShop.readyState==4){	
				if(SistemaShop.responseText==1) //Lider
				{
					location.href="PrincipalLider.asp";
				} else if(SistemaShop.responseText==2)  { //Membro
					location.href="PrincipalMembro.asp";
				} else {
					alert(SistemaShop.responseText);
				}
			}}
			SistemaShop.send("Combo=AcessarPainel&ID="+ID+"&Senha="+Senha);
		}
		</script>

    </body>

</html>
