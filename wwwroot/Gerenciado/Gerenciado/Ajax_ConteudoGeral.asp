<!--#include file="include/sistemas.asp"-->
<!--#include file="include/Class_Divs.asp"-->
<!--#include file="include/ObterNicks.asp"-->
<!--#include file="fix_injection.asp"-->

<%
Call  ConectaBD
Combo = request("Combo")

If Combo = "AcessarPainel" Then

	Id = Request("ID")
	Id = replace(Id,"'","")	
	Id = replace(Id,".","")	
	Id = replace(Id,"-","")	
	Id = replace(Id,"/","")			
				
	Senha = Request("Senha")
	Senha = replace(Senha,"'","")	
	Senha = replace(Senha,".","")	
	Senha = replace(Senha,"-","")	
	Senha = replace(Senha,"/","")	
	
	CheckStringForSQL(Id)
	CheckStringForSQL(Senha)

	Sql = " SELECT * FROM [accountdb].[dbo].["&UCASE(LEFT(Id,1))&"GameUser] WHERE USERID = '"&Id&"' AND PASSWD = '"&Senha&"' "
	Set Rs = Conexao.Execute(Sql)
	
	If Not Rs.Eof Then
		
		Sql = " SELECT BlockChk FROM [accountdb].[dbo].["&UCASE(LEFT(Id,1))&"GameUser] WHERE USERID = '"&Id&"' "
		Set RsBloqueado = Conexao.EXECUTE(Sql)

			If Not RsBloqueado.eof THEN
				If RsBloqueado("BlockChk") = 1 Then
				  Bug "Sua conta esta bloqueada no servidor,<br>Contate o administrador."
				End If
			END IF

		Session("ID") = Rs("USERID")

		Sql = " SELECT * FROM [ClanDb].[DBO].[CL] WHERE USERID = '"&Id&"' "
		Set RsClan = Conexao.EXECUTE(Sql)
			
		If Not RsClan.Eof Then
			Session("Player") = "LIDER"
			Bug 1
		Else
			Session("Player") = "MEMBRO"
			Bug 2
		End If	
	Else
		Bug "Dados incorretos, por favor digite novamente."
	End If		

End If

if Combo = "CarregaListaClan" Then

	Sql = " SELECT * FROM [CLANDB].[DBO].[UL] WHERE CLANNAME = '"&RetornaClanUsuario(Session("ID"),"ClanName")&"'"
	Set Rs = Conexao.Execute(Sql)
	
	If Not Rs.Eof Then %>

	<table cellpadding="8" style="margin-left:15px;">
    
<%	While Not Rs.Eof 
	j = j + 1
	
	Sql = " SELECT * FROM [CLANDB].[DBO].[CT] WHERE USERID = '"&Rs("Userid")&"' "
	Set RsOnOff = Conexao.Execute(Sql)
%>
 	<tr>
        	<td><center><img src="img/Classes/<%=Rs("ChType")%>.gif" align="abdmiddle" /></center></td>
			<td><center><%=Rs("ChName")%></center></td>
            <td><center><%=Rs("ChLv")%></center></td>
            <td><center>
				<% If RsOnOff.Eof Then				
					Rw "<img src='img/off.png' align='absmiddle' width='12'>"
				   Else
				   	Rw "<img src='img/on.png' align='absmiddle' width='12'>"
				   End If
				%>	
			</center></td>
            <% If Session("ID") <> Rs("UserId") Then %>
            	<td>
            		<small><font size="1">kick</font></small>
                	<center>
                		<input type="checkbox" id="kick_<%=Rs("UserId")%>" name="kick_<%=Rs("UserId")%>" onclick="KickarMembro('<%=Rs("UserId")%>','<%=Rs("ClanName")%>');" />
                	</center>
            	</td>
            <% End If

               If Rs("Permi") = 1 Then 
				Rw "<td><font colore='orange' size='1'>Vice</font></td>"
			   End if 
			%>
        </tr>
<% 	Rs.MoveNext
	Wend %>
    </table>
<% Else %>
	<tr>
		<td><font size="2">Nenhum usuário encontrado.</font></td>
	</tr>	
<%	End If
End If

if Combo = "CarregaListaClanMembro" Then

	Sql = " SELECT * FROM [CLANDB].[DBO].[UL] WHERE USERID = '"&Session("ID")&"'"
	Set RsPegaClan = Conexao.Execute(Sql)
	
	If RsPegaClan.Eof Then
		bug "Nenhum clan foi encontrado."
	Else
	
	Sql = " SELECT * FROM [CLANDB].[DBO].[UL] WHERE CLANNAME = '"&RsPegaClan("ClanName")&"'"
	Set Rs = Conexao.Execute(Sql)

	On error resume next
	Err.clear()
	Set Rs = Conexao.Execute(Sql)
	
	If Err.number <> 0 then
	
		Response.write("Erro no banco de dados.")
		Response.end()
	
	End if
	
	If Not Rs.Eof Then %>

	<table cellpadding="8" style="margin-left:15px;">
    
<%	While Not Rs.Eof 
	j = j + 1
	
	Sql = " SELECT * FROM [CLANDB].[DBO].[CT] WHERE USERID = '"&Rs("Userid")&"' "
	Set RsOnOff = Conexao.Execute(Sql)
%>
 	<tr>
        	<td><center><img src="img/Classes/<%=Rs("ChType")%>.gif" align="abdmiddle" /></center></td>
			<td><center><%=Rs("ChName")%></center></td>
            <td><center><%=Rs("ChLv")%></center></td>
            <td><center>
				<% If RsOnOff.Eof Then				
					Rw "<img src='img/off.png' align='absmiddle' width='12'>"
				   Else
				   	Rw "<img src='img/on.png' align='absmiddle' width='12'>"
				   End If
				%>	
			</center></td>
            <% If Rs("Permi") = 1 Then 
				Rw "<td><font colore='orange' size='1'>Vice</font></td>"
			   End if 
			%>
        </tr>
<% 	Rs.MoveNext
	Wend %>
    </table>
<% Else %>
	<tr>
		<td><font size="2">Nenhum usuário encontrado.</font></td>
	</tr>	
<%	End If
 End If
End If


If Combo = "KickarMembro" Then
	CheckStringForSQL(Request("ClanName"))
	CheckStringForSQL(Request("UserId"))
	Sql = " UPDATE CL SET MEMCNT = MEMCNT-1 WHERE CLANNAME = '"&Request("ClanName")&"' "
	Conexao.Execute(Sql)
	
	Sql = " DELETE FROM UL WHERE USERID = '"&Request("UserId")&"' "
	Conexao.Execute(Sql)  

End If

If Combo = "CarregaInfoslan" THen
%>
	<div style="margin-left:16px;">
    <h3 class="page-header text-asbestos">Administração do clan - 
    <img src="<%=Session("CaminhoTAGClan")&RetornaClanUsuario(Session("ID"),"MIconCnt")&".bmp"%>" width="30" height="30" align="absmiddle"/> 
	<%=RetornaClanUsuario(Session("ID"),"ClanName")%>

    <img src="img/editar.png" width="18" height="18" align="absmiddle" data-toggle="modal" data-target="#myModalTag" style="cursor:pointer;" title="Editar dados" />    

    <br>
    <input type="hidden" id="clan" name="clan" value="<%=RetornaClanUsuario(Session("ID"),"ClanName")%>">
    <font size="2">Frase: <%=RetornaClanUsuario(Session("ID"),"Note")%> <img src="img/editar.png" width="18" height="18" align="absmiddle" data-toggle="modal" data-target="#myModal" style="cursor:pointer;" title="Editar dados" /></font><br />
    <font size="2">Membros: <%=RetornaClanUsuario(Session("ID"),"MemCnt")%></font> </h3>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Alterar frase do clan</h4>
          </div>
          <div class="modal-body">
            <table>
                <tr>
                    <td><font size="2">Olá <%=VerificaNomeUsuario(Session("ID"))%>, você deseja alterar a frase do seu clan?</font></td>
                </tr>
                <tr>
                    <td><input type="text" id="frase" name="frase" value="<%=RetornaClanUsuario(Session("ID"),"Note")%>" class="form-control" /></td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-info" data-dismiss="modal" onClick="AlterarFraseClan('<%=RetornaClanUsuario(Session("ID"),"ClanName")%>');">Salvar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModalTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Alterar tag do clan</h4>
          </div>
          <div class="modal-body">
            <table>
                <tr>
                    <td><font size="2">Olá <%=VerificaNomeUsuario(Session("ID"))%>, você deseja alterar a tag do seu clan?</font></td>
                </tr>
                <tr><td>
					<%
					dim nome_arquivo : nome_arquivo = CaminhoClanContent
					Set FSO = Server.CreateObject("Scripting.FileSystemObject")
                    Set principal = FSO.GetFolder(nome_arquivo) ' coloque a pasta principal
                    Set arquivos = principal.Files
                    
                    'criando vetor
                    dim nome
                    nome=array()
                    For each arq in arquivos
                    redim preserve nome(Ubound(nome)+1)
                    nome(Ubound(nome)) = arq.name
                    next
                    
                    'listando arquivos
                    For x = 0 to Ubound(nome)-2
						Sql = " select MIconCnt from [ClanDb].[dbo].[CL] where MIconCnt ='"&Replace(nome(x),".bmp","")&"'"
						Set RsLi = Conexao.Execute(Sql)
						if RsLi.Eof then
							Rw "<input type='hidden' id='"&Cint(x+1)&"' name='"&Cint(x+1)&"' value='"&Replace(nome(x),".bmp","")&"' />" 
							
							Rw "<img data-dismiss='modal' src='"&Session("CaminhoTAGClan")&nome(x)&"' style='cursor:pointer; border:1px solid #fdfdfd;' title='"&Replace(nome(x),".bmp","")&"' onClick='AlteraTagClan("&Cint(x+1)&");'/>"
						End If
                    Next
                    %>
                </td></tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="btn-group">
      <button type="button" class="btn btn-danger" onclick="ExcluirClan('<%=RetornaClanUsuario(Session("ID"),"ClanName")%>');">Excluir clan</button>
    </div> 
    
    <div class="btn-group">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalVicLider">Vice-Lider</button>
	  <!--<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
      </ul>-->
    </div>    
       
    
    <div class="btn-group">
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalLider">Delegar clan</button>
	  <!--<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
      </ul>-->
    </div>    

    <br /><br />
    
    <!-- Modal -->
    <div class="modal fade" id="myModalVicLider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Alterar vice-lider do clan</h4>
          </div>
          <div class="modal-body">
            <table>
                <tr>
                    <td><font size="2">Olá <%=VerificaNomeUsuario(Session("ID"))%>, você deseja alterar o vice lider do seu clan? O atual está selecionado.</font></td>
                </tr>
                <% Sql = " SELECT * FROM UL WHERE CLANNAME = '"&RetornaClanUsuario(Session("ID"),"ClanName")&"' AND USERID NOT IN ('"&Session("ID")&"')"
				   Set RsViceLider = Conexao.Execute(Sql) 
				   
				   If Not RsViceLider.Eof Then
					While Not RsViceLider.Eof
					j = j + 1
				%>
                	<tr>
                    	<td>
                        	<div class="col-lg-6">
								<div class="input-group">
								  <span class="input-group-addon">
									<input type="radio" name="vicelider" id="vicelider_<%=j%>" <%If RsViceLider("Permi") = 1 Then Rw "CHECKED" end if%> >
								  </span>
									<input type="text" class="form-control" id="nome_vicelider_<%=j%>" value="<%=RsViceLider("ChName")%>">
								</div><!-- /input-group -->
							  </div><!-- /.col-lg-6 -->
							</div><!-- /.row -->	
						</td>
                    </tr>                
                <%	RsViceLider.MoveNext
					Wend
				   Else
				   		Rw "Nenhum membro no seu clan."
				   End If	
				%>
            </table>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-info" data-dismiss="modal" onClick="AlteraVicLider('<%=RetornaClanUsuario(Session("ID"),"ClanName")%>');">Vice-lider</button>
            <input type="hidden" id="qnt_membros" name="qnt_membros" value="<%=j%>" />
          </div>
        </div>
      </div>
    </div>
   
    <!-- Modal -->
    <div class="modal fade" id="myModalLider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Delegar liderança do clan</h4>
          </div>
          <div class="modal-body">
            <table>
                <tr>
                    <td><font size="2">Olá <%=VerificaNomeUsuario(Session("ID"))%>, você deseja deletar a liderança?</font></td>
                </tr>
                <% Sql = " SELECT * FROM UL WHERE CLANNAME = '"&RetornaClanUsuario(Session("ID"),"ClanName")&"' AND USERID NOT IN ('"&Session("ID")&"')"
				   Set RsLider = Conexao.Execute(Sql) 
				   
				   If Not RsLider.Eof Then
					While Not RsLider.Eof
					l = l + 1
				%>
                	<tr>
                    	<td>
                        	<div class="col-lg-6">
								<div class="input-group">
								  <span class="input-group-addon">
									<input type="radio" name="lider" id="lider_<%=l%>">
								  </span>
									<input type="text" class="form-control" id="nome_lider_<%=l%>" value="<%=RsLider("ChName")%>">
									<input type="hidden" class="form-control" id="id_lider_<%=l%>" value="<%=RsLider("UserID")%>">
								</div><!-- /input-group -->
							  </div><!-- /.col-lg-6 -->
							</div><!-- /.row -->	
						</td>
                    </tr>                
                <%	RsLider.MoveNext
					Wend
				   Else
				   		Rw "Nenhum membro no seu clan."
				   End If	
				%>
            </table>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-info" data-dismiss="modal" onClick="AlteraLider('<%=RetornaClanUsuario(Session("ID"),"ClanName")%>');">
            Delegar</button>
            <input type="hidden" id="qnt_membros_lider" name="qnt_membros_lider" value="<%=l%>" />          
          
          </div>
        </div>
      </div>
    </div>


	</div>

<%
End If


If Combo = "CarregaInfoslanMembro" THen
%>
<br />
<% If RetornaClanUsuarioMembro(Session("ID"),"ClanName") <> "---" Then %>
   <div class="btn-group">
      <button type="button" class="btn btn-danger" onclick="SairdoClan('<%=Session("ID")%>');" style="margin-left:15px;">Sair do clan</button>
    </div>
<% Else %>
   <div class="btn-group">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalCriarClan" style="margin-left:15px;">Criar Clan</button>
   </div>
    
    <div class="modal fade" id="myModalCriarClan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Criar clan</h4>
          </div>
          <div class="modal-body">
            <table>
                <tr>
                    <td><font size="2">Olá <%=VerificaNomeUsuario(Session("ID"))%>, você deseja criar um clan?</font></td>
                </tr>
				<tr>
                	<td>Criação de clans está em desenvolvimento.</td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-info" data-dismiss="modal" onClick="AlteraLider('<%=RetornaClanUsuario(Session("ID"),"ClanName")%>');">
            Criar</button>
          </div>
        </div>
      </div>
    </div>
    
<% End If %>
<br /><br />
<%
End If



If Combo = "AlterarFraseClan" Then
CheckStringForSQL(Request("frase"))
CheckStringForSQL(Request("clan"))
	Sql = " UPDATE [ClanDB].[Dbo].[CL] SET NOTE = '"&Replace(Request("frase"),"|"," ")&"' WHERE CLANNAME = '"&Request("clan")&"'"
	Conexao.Execute(Sql)

End If

If Combo = "AlteraTagClan" Then

	Dim fso, oFile, RsLi

	Set fso = Server.CreateObject("Scripting.FileSystemObject")
	Set fso1 = Server.CreateObject("Scripting.FileSystemObject")

	Set RsLi = Server.CreateObject("ADODB.RecordSet")
	
	Sql = " SELECT IMG FROM LI "
	Set RsLi = Conexao.Execute(Sql)
	
	If fso.FileExists(CaminhoClanContent&"\"&RsLi(0)&".bmp") = True then

		FSO.MoveFile CaminhoClanContent&"\"&RsLi(0)&".bmp", CaminhoClanContent&"\"&RsLi(0)+10000&".bmp"
		Set FSO = Nothing
		
	End If
	
	CheckStringForSQL(Request("tag"))
	fso1.MoveFile CaminhoClanContent&"\"&Request("tag")&".bmp", CaminhoClanContent&"\"&RsLi(0)&".bmp"
	Set fso1 = Nothing

	Sql = " UPDATE CL SET MICONCNT = '"&RsLi(0)&"' WHERE CLANNAME = '"&RetornaClanUsuario(Session("ID"),"ClanName")&"' "
	Conexao.Execute(Sql)
	
	Sql = " UPDATE UL SET MICONCNT = '"&RsLi(0)&"' WHERE CLANNAME = '"&RetornaClanUsuario(Session("ID"),"ClanName")&"' "
	Conexao.Execute(Sql)
	
	Sql = " UPDATE LI SET IMG = '"&RsLi(0)+1&"'"
	Conexao.Execute(Sql)	
	
End if

If Combo = "ExcluirClan" Then
	CheckStringForSQL(Request("clan"))

	Sql = " EXEC SairClan @ClanName = '"&Request("clan")&"', @UserId = '"&Session("ID")&"'"
	Conexao.Execute(Sql)

End If

if Combo = "AlteraVicLider" THen
CheckStringForSQL(Request("clan"))
CheckStringForSQL(Request("Player"))
	Sql = " UPDATE UL SET PERMI = 0 WHERE CLANNAME = '"&Request("clan")&"'"
	Conexao.Execute(Sql)

	Sql = " UPDATE UL SET PERMI = 1 WHERE CLANNAME = '"&Request("clan")&"' AND CHNAME = '"&Request("Player")&"'"
	Conexao.Execute(Sql)

End If

if Combo = "AlteraLider" THen
CheckStringForSQL(Request("IDNovoLider"))
CheckStringForSQL(Request("Player"))
	Sql = " UPDATE CL SET USERID = '"&Request("IDNovoLider")&"', CLANZANG = '"&Request("Player")&"' WHERE USERID = '"&Session("ID")&"' "
	Conexao.Execute(Sql)

	Session("Player") = "MEMBRO"

End If

If Combo = "ExcluirClan" Then
	CheckStringForSQL(Request("clan"))
	Sql = " DELETE FROM CL WHERE CLANNAME = '"&Request("clan")&"'"
	Conexao.Execute(Sql)
	
	Sql = " DELETE FROM UL WHERE CLANNAME = '"&Request("clan")&"'"
	Conexao.Execute(Sql)

End If
%>