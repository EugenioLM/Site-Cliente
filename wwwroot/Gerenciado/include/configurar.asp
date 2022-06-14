<%
	' ESCRITO POR BRUNO SOBRAL PASSOS/LOOKIN (bruninhu.vdn@hotmail.com)
	' DATA: 14/02/2014
	' CONFIGURE CORRETAMENTE PARA NÃO OCORRER PROBLEMAS E NÃO ESQUEÇA DE EXECUTAR A QUERY NA DB (LOOKIN)

	Dim licenca : licenca = "vc9kxzoW0Gk="

	Dim NomeSql
	Dim IdSql
	Dim SenhaSql
	Public CaminhoClanContent

	NomeSql	 = "SERVER\SQLEXPRESS"
	IdSql	 = "sa"
	SenhaSql = "m@2409"
	Session("NomeServidor") = "TestePT"
	Session("Caminho") = "C:\ServidorrPT\"
	Session("CaminhoTAGClan") = "http://51.222.99.152/ClanContent/"
	CaminhoClanContent = "C:\inetpub\wwwroot\ClanContent"

	Public Conexao
	Public Sub ConectaBD()
	Set Conexao = Server.CreateObject("ADODB.Connection") 
	On error resume next
	Err.clear()
	Conexao.Open "Driver={SQL Server};Server="&NomeSql&";Database=ClanDb;Uid="&IdSql&";Pwd="&SenhaSql&";" 
	
		If Err.number <> 0 then
	
			Response.write("Erro no banco de dados.")
			Response.end()
	
		End if

	End Sub
	
	Dim Sql
	Dim Rs
	Set Rs = Server.CreateObject("ADODB.Recordset")
%>