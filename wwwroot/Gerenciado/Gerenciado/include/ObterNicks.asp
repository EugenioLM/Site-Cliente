<!--#include file="funcoes.asp"-->
<%
	'Arquivo escrito por Bruno Sobral Passos
	'Data de criação: 26/01/2013
	'Descrição do arquivo:  

	'Criando array de 5 posições
	Dim ArrayNicks(5) 
	
	'Declarando variveis
	Dim Personagens , i , strFilePath 

	'Declarando constante
	Const adTypeBinary = 1 

	'Obtendo numero da pasta pelo ID
	Pasta = numDir(Session("ID"))
	
	'Caminho do arquivo (Player)
	strFilePath = Session("Caminho")&"DataServer\userinfo\"&Pasta&"\"&Session("ID")&".dat"

	'bUG strFilePath

	'Criando Objeto Stream
	Set objStream = Server.CreateObject("ADODB.Stream")
	
	'Abrindo o arquivo
	objStream.Open
	
	'Define ou retorna o tipo de dados em um objeto Stream
	objStream.Type = adTypeBinary
	
	'O nome de um arquivo existente para ser carregado em uma corrente do objeto
	On error resume next
	Err.clear()
	objStream.LoadFromFile strFilePath
	If Err.number <> 0 then
		'Rw "<img src='imgs/problema.png' width='30' height='30' align='absmiddle' border='0' /> Antes de acessar o painel shop, crie seu personagem no jogo."
	'	Response.End()
	End If
	
	'Obtendo informações do arquivo (.dat)
	Personagens = objStream.Read
	
	'Fechando arquivo
	objStream.Close
	
	'Setando variavel com vazio
	Set objStream = Nothing	
	
	'Quebrando variavel para obter cada personagem.
	ArrayNicks(1) = Trim(Mid(Personagens,20,15))  'Personagem: 1
	ArrayNicks(2) = Trim(Mid(Personagens,35,15))  'Personagem: 2
	ArrayNicks(3) = Trim(Mid(Personagens,55,15))  'Personagem: 3
	ArrayNicks(4) = Trim(Mid(Personagens,70,15))  'Personagem: 4 
	ArrayNicks(5) = Trim(Mid(Personagens,85,15))  'Personagem: 5
	
	'Final do arquivo.
%>