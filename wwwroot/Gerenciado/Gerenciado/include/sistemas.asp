<!--#include file="configurar.asp"-->
<!--#include file="funcoes.asp"-->
<%
Call ConectaBD()

Public Retorno

Public Function RetornaTitleSistema()
	RetornaTitleSistema = "Painel de sistemas SinglePK"
End Function

Public Function VerificaSession()
	If Session("ID") = "" Then
		Response.Redirect("FinalizaSecao.asp?t=2")
	End If
End Function

Public Function VerificaUsuarioON(ByVal UserId, ByVal Tipo)

	If UserId <> "" Then
		Sql = " SELECT * FROM [CLANDB].[DBO].[CT] WHERE USERID = '" & UserId & "'"
		Set Rs = Conexao.Execute(Sql)
		If Not Rs.Eof Then
			If Tipo = 1 Then
				Retorno = "<img src='img/on.png' align='absmiddle' width='12'> Online"
			Else
				Retorno = "<img src='img/on.png' align='absmiddle' width='12'>"
			End if
		Else
			If Tipo = 1 Then
				Retorno = "<img src='img/off.png' align='absmiddle' width='12'> Offline"
			Else
				Retorno = "<img src='img/off.png' align='absmiddle' width='12'>"
			End If
		End If
	Else
		If Tipo = 1 Then
			Retorno = "<img src='img/off.png' align='absmiddle' width='12'> Offline"
		Else
			Retorno = "<img src='img/off.png' align='absmiddle' width='12'>"
		End If
	End If
	
	VerificaUsuarioON = Retorno

End Function

Public Function VerificaNomeUsuario(ByVal UserId)

	Sql = " SELECT CUserName1, CUserName2 FROM [ACCOUNTDB].[DBO].[ALLPERSONALMEMBER] WHERE USERID = '" & UserId & "'"
	Set Rs = Conexao.Execute(Sql)
	
	If Not Rs.Eof Then
		Retorno = Rs(0) & " <strong>"&Rs(1)&"</strong>"
	Else
		Retorno = "Sem nome"
	End If
	
	VerificaNomeUsuario = Retorno

End Function

Public Function RetornaClanUsuario(ByVal UserId, ByVal Campo)

	Sql = " SELECT TOP 1 * FROM CL AS CL INNER JOIN UL AS UL ON UL.CLANNAME = CL.CLANNAME WHERE CL.USERID = '" & UserId & "'"
	Set Rs = Conexao.Execute(Sql)
	
	If Not Rs.Eof Then
		Retorno = Rs(Campo)
	Else
		Retorno = "---"
	End If
	
	RetornaClanUsuario = Retorno

End Function

Public Function RetornaClanUsuarioMembro(ByVal UserID, ByVal Campo)

	Sql = " SELECT TOP 1 * FROM UL WHERE USERID = '" & UserID & "'"
	'Bug Sql
	Set Rs = Conexao.Execute(Sql)
	
	If Not Rs.Eof Then
		Retorno = Rs(Campo)
	Else
		Retorno = "---"
	End If
	
	RetornaClanUsuarioMembro = Retorno

End Function

Public Function RetornaClasse(ByVal UserId)

	Sql = " SELECT * FROM [CLANDB].[DBO].[UL] WHERE USERID = '" & UserId & "'"
	Set Rs = Conexao.Execute(Sql)
	
	If Not Rs.Eof Then
		Retorno = Rs("ChType")
	Else
		Retorno = "user_sem_foto"
	End If
	
	RetornaClasse = Retorno

End Function


Function VerificarLiderClan(ByVal UserId)
		
	Sql = " SELECT * FROM [CLANDB].[DBO].[CL] WHERE USERID = '"&UserId&"' "
	Set RsLiderClan = Conexao.EXECUTE(Sql)
		
	If Not RsLiderClan.Eof Then
		retorno = "<a href='#' class='active'><br><br> Administrar Clan</a>"	
	Else
		retorno = "<a href='#' class='active'><br><br> Visualizar Membros</a>"	
	End If
	
	VerificarLiderClan = retorno

End Function

Function RandomizeGold()

	RANDOMIZE
	RandomizeGold = Round(Int((50000000-60000000+1)*Rnd+60000000))

End Function


%>