<!--#include file="include/sistemas.asp"-->
<!DOCTYPE html>
<html>
<head>
<title>Gerênciar Clans  </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="Mint by Grozav is a flat design approach towards Admin Dashboards. Intuitive, cutting-edge, clean and easy to use and customize, as every Application UI should be. ">
<meta name="keywords" content="mint, flat, admin, dashboard, app, template, theme, grozav, admin template, admin dashboard, bootstrap, admin bootstrap, awesome" />
<link rel="author" href="http://grozav.com"/>

<!-- Core CSS - Include with every page -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

<!-- Page-Level Plugin CSS - Dashboard -->
<link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
<link href="css/plugins/timeline/timeline.css" rel="stylesheet">

<!-- Mint Admin CSS - Include with every page -->
<link href="css/mint-admin.css" rel="stylesheet">
</head>
<%=VerificaSession()%>
<% 
	If Session("Player") = "MEMBRO" Then
		Bug "<script>window.alert(""Desculpe, mas voce não é líder de nenhum clan."");location.href=""PrincipalMembro.asp""</script>"
	End If
%>
<body>
<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
      <li>
        <div class="user-info-wrapper">
          <div class="user-info-profile-image"> <img src="img/Classes/<%=RetornaClasse(Session("ID"))%>.png" width="65" height="65"> </div>
          <div class="user-info">
            <div class="user-welcome">Bem-vindo</div>
			<div class="username"><%=VerificaNomeUsuario(Session("ID"))%></div>
             <div class="status">Status <span class="status-now"> <%=VerificaUsuarioON(Session("ID"),1)%></span> </div>
            <a href="FinalizaSecao.asp">Sair do painel</a>
          </div>
        </div>
      </li>
      </li>
      	<li><%=VerificarLiderClan(Session("ID"))%></li>
      </li>
    </ul>
    </li>
    </ul>
  </div>
</nav>
<div id="page-wrapper">
<div class="row">
  <div class="col-lg-12">
  	<span id="DIvCarregaInfosClan"></span>  
  </div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
  <div class="panel-heading"> <i class="fa fa-sign-out fa-fw"></i> Informações do clan </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="list-group">
    	<span id="DivCarregaDados"></span>
	</div>
  </div>	
</div>
</div>
  	
<!-- Core Scripts - Include with every page --> 
<script src="js/jquery-1.10.2.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script> 

<!-- Page-Level Plugin Scripts - Dashboard --> 
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script> 
<script src="js/plugins/morris/morris.js"></script> 

<!-- Mint Admin Scripts - Include with every page --> 
<script src="js/mint-admin.js"></script> 

<!-- Page-Level Demo Scripts - Dashboard - Use for reference --> 
<script src="js/demo/dashboard-demo.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
</body>
</html>

<script type="text/javascript">
window.onload=function()
{
	CarregaInfoslan();
	setTimeout("CarregaListaClan();",2000);
}

function CarregaInfoslan()
{
	var SistemaS = createXMLHTTP();
	SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
	SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	SistemaS.onreadystatechange=function(){
	if (SistemaS.readyState==4){	
		document.getElementById("DIvCarregaInfosClan").innerHTML = SistemaS.responseText;
	}}
	SistemaS.send("Combo=CarregaInfoslan");
}

function CarregaListaClan()
{
	document.getElementById("DivCarregaDados").innerHTML = "Carregando...";
	
	var SistemaS = createXMLHTTP();
	SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
	SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	SistemaS.onreadystatechange=function(){
	if (SistemaS.readyState==4){
		document.getElementById("DivCarregaDados").innerHTML = SistemaS.responseText;
	}}
	SistemaS.send("Combo=CarregaListaClan");
}

function KickarMembro(UserId,ClanName)
{
	if(confirm("Você deseja kickar esse membro do clan?")==true)
	{
		var SistemaS = createXMLHTTP();
		SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
		SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		SistemaS.onreadystatechange=function(){
		if (SistemaS.readyState==4){	
			//alert(SistemaS.responseText);
			setTimeout("CarregaInfoslan();",100);
			setTimeout("CarregaListaClan(1);",200);
		}}
		SistemaS.send("Combo=KickarMembro&UserId="+UserId+"&ClanName="+ClanName);
	} else {
		document.getElementById('kick_'+UserId).checked = false;
	}
}

function AlterarFraseClan(ClanName)
{
	var frase = document.getElementById("frase").value.replace(/ /gi,"|");
	
	var SistemaS = createXMLHTTP();
	SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
	SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	SistemaS.onreadystatechange=function(){
	if (SistemaS.readyState==4){	
		location.href="PrincipalLider.asp";
		//setTimeout("CarregaInfoslan();",100);
	}}
	SistemaS.send("Combo=AlterarFraseClan&clan="+ClanName+"&frase="+frase);
}

function AlteraTagClan(tag)
{
	if(confirm("Você deseja alterar a tag do seu clan?")==true)
	{
		var SistemaS = createXMLHTTP();
		SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
		SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		SistemaS.onreadystatechange=function(){
		if (SistemaS.readyState==4){	
			//document.getElementById("DivCarregaDados").innerHTML = SistemaS.responseText;
			//setTimeout("CarregaInfoslan();",100);
			location.href="PrincipalLider.asp";
		}}
		SistemaS.send("Combo=AlteraTagClan&tag="+document.getElementById(tag).value);
	}
}

function AlteraVicLider(ClanName)
{
	if(confirm("Você deseja alterar o vice-lider do seu clan?")==true)
	{
		var playervicelider;
		
		for(var i=1;i<parseFloat(document.getElementById("qnt_membros").value)+parseFloat(1);i++)
		{
			if(document.getElementById('vicelider_'+i).checked==true)
			{
				playervicelider = document.getElementById('nome_vicelider_'+i).value;	
						
				var SistemaS = createXMLHTTP();
				SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
				SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				SistemaS.onreadystatechange=function(){
				if (SistemaS.readyState==4){	
					setTimeout("CarregaListaClan();",100);
				}}
				SistemaS.send("Combo=AlteraVicLider&clan="+ClanName+"&Player="+playervicelider);
			}
		}
	}
}


function AlteraLider(ClanName)
{
	if(confirm("Você deseja deletar sua liderança?")==true)
	{
		var playerlider;
		var id_lider;
		
		for(var i=1;i<parseFloat(document.getElementById("qnt_membros_lider").value)+parseFloat(1);i++)
		{
			if(document.getElementById('lider_'+i).checked==true)
			{
				playerlider = document.getElementById('nome_lider_'+i).value;	
				id_lider = document.getElementById('id_lider_'+i).value;
				var SistemaS = createXMLHTTP();
				SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
				SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				SistemaS.onreadystatechange=function(){
				if (SistemaS.readyState==4){	
					//alert(SistemaS.responseText);
					//document.getElementById("DivCarregaDados").innerHTML = SistemaS.responseText;
					alert("Liderança deletaga com sucesso.");
					setTimeout("location.href='PrincipalMembro.asp';",1000);				
					//setTimeout("CarregaListaClan();",100);
				}}
				SistemaS.send("Combo=AlteraLider&clan="+ClanName+"&Player="+playerlider+"&IDNovoLider="+id_lider);
			}
		}
	}
}



function ExcluirClan(ClanName)
{
	if(confirm("Você deseja excluir o clan?")==true)
	{
		var SistemaS = createXMLHTTP();
		SistemaS.open("post", "Ajax_ConteudoGeral.asp", true);	
		SistemaS.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		SistemaS.onreadystatechange=function(){
		if (SistemaS.readyState==4){	
			alert("Você excluir o clan, você está sendo redirecionado para página default.");
			setTimeout("location.href='FinalizaSecao.asp';",1000);
		}}
		SistemaS.send("Combo=ExcluirClan&clan="+ClanName);
	}
}
</script>