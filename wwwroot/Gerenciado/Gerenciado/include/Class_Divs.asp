<%
' Autor: Bruno Sobral
' Data: 23/11/2012

'Exemplo
'Largura, Altura, Margem (Topo,Direita,Baixo,Esqueda), Cor (Nome), Nome e Id, Espessura e Conteudo - Parâmetros para configurar.

'Rw ConfiguraDiv("28%", "auto", 5, 0, 0, 0, "VERMELHO", "RespostaCli", "1" , "<b>CLIENTE N&Atilde;O CADASTRADO </b>")

Public Function ConfiguraDiv(Largura, Altura, MargemT, MargemD, MargemB, MargemE , CorFundo, Nome, EspessuraBorda, Conteudo)

Dim Background
Dim Border
Dim CorFonte

	Select Case Ucase(CorFundo)

		Case "VERMELHO"
			Background = "#ff5544"
			Border = "#b42011"
			CorFonte = "#fff"
	
		Case "VERDE"
			Background = "#d5f7b3"
			Border = "#a6de6e"
			CorFonte = "#333"		
	
		Case "AZUL"
			Background = "#cee6fa"
			Border = "#72aad9"
			CorFonte = "#333"		
	
		Case "AMARELO"
			Background = "#fef8cb"
			Border = "#debe00"
			CorFonte = "#333"
	
		Case "LARANJA"
			Background = "#fea25f"
			Border = "#f96900"
			CorFonte = "#333"		

		Case "TRANSPARENTE"
			Background = "#f0f0f0"
			Border = "#e2e2e2"
			CorFonte = "#333"		
			
	End Select
	
	ConfiguraDiv = "<div id="&Nome&" name="&Nome&" style=""background-color:"&Background&"; border:"&EspessuraBorda&"px solid "&Border&"; color:"&CorFonte&"; width:"&Largura&"; height:"&Altura&"; margin:"&MargemT&"px "&MargemD&"px "&MargemB&"px "&MargemE&"px; padding:5px;"" class=""DivConteudoTextos"">"&Conteudo&"</div>"	
	
End Function  


Public Function ConfiguraDivIcone(Largura, Altura, MargemT, MargemD, MargemB, MargemE , CorFundo, Nome, EspessuraBorda, CaminhoIcone, Conteudo)

Dim Background
Dim Border
Dim CorFonte

	Select Case Ucase(CorFundo)

		Case "VERMELHO"
			Background = "#ff5544"
			Border = "#b42011"
			CorFonte = "#fff"
	
		Case "VERDE"
			Background = "#d5f7b3"
			Border = "#a6de6e"
			CorFonte = "#333"		
	
		Case "AZUL"
			Background = "#cee6fa"
			Border = "#72aad9"
			CorFonte = "#333"		
	
		Case "AMARELO"
			Background = "#fef8cb"
			Border = "#debe00"
			CorFonte = "#333"
	
		Case "LARANJA"
			Background = "#fea25f"
			Border = "#f96900"
			CorFonte = "#333"		

		Case "TRANSPARENTE"
			Background = "#f6f6f6"
			Border = "#f6f6f6"
			CorFonte = "#333"		
			
	End Select
	ConfiguraDivIcone = "<div id="&Nome&" name="&Nome&" style=""background-color:"&Background&"; border:"&EspessuraBorda&"px solid "&Border&"; color:"&CorFonte&"; width:"&Largura&"; height:"&Altura&"; margin:"&MargemT&"px "&MargemD&"px "&MargemB&"px "&MargemE&"px; padding:5px;""> <img src=""../IMG_GERENCIAL/"&CaminhoIcone&""" width=""16"" height=""16"" border=""0"" align=""absmiddle""/> "&Conteudo&"</div>"	
	
End Function  


Public Function ConfiguraH3(Largura,Conteudo)

	ConfiguraH3 = "<h3 class=""h3"" style=""width:"&Largura&"; margin-left:5px;""> "&UCASE(Conteudo)&" </h3>"	

End Function

%>