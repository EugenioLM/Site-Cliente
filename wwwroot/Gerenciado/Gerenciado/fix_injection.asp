<%
'  fix_injection.asp
'
'  Author: Nazim Lala, Codificar (http://www.codificar.com.br)
'  Modified Date: 26-05-2008
'  This is the include file to use with your asp pages to
'  validate input for SQL injection.
Dim BlackList, ErrorPage
'
'  Below is a black list that will block certain SQL commands and
'  sequences used in SQL injection will help with i\0 putaput sanitization
'
'  However this is may not suffice, because:
'  1) These might not cover all the cases (like encoded characters)
'  2) This may disallow legitimate input
'
'  Creating a raw sql query strings by concatenating user input is
'  unsafe programming practice. It is advised that you use parameterized
'  SQL instead. Check http://support.microsoft.com/kb/q164485/ for information
'  on how to do this using ADO from ASP.
'
'  Moreover, you need to also implement a white list for your parameters.
'  For example, if you are expecting input for a zipcode you should create
'  a validation rule that will only allow 5 characters in [0-9].
'
BlackList = Array("--", ";", "/*", "*/", "@@", "@",_
"char", "nchar", "varchar", "nvarchar",_
"alter", "begin", "cast", "create", "cursor",_
"declare", "delete", "drop", "end", "exec",_
"execute", "fetch", "insert", "kill", "open",_
"select", "sys", "sysobjects", "syscolumns",_
"table", "update")
'  Populate the error page you want to redirect to in case the
'  check fails.
ErrorPage = "error.asp"
'''''''''''''''''''''''''''''''''''''''''''''''''''
'  This function does not check for encoded characters
'  since we do not know the form of encoding your application
'  uses. Add the appropriate logic to deal with encoded characters
'  in here
'''''''''''''''''''''''''''''''''''''''''''''''''''
Function CheckStringForSQL(str)
On Error Resume Next
Dim lstr
' If the string is empty, return true
If ( IsEmpty(str) ) Then
CheckStringForSQL = false
Exit Function
ElseIf ( StrComp(str, "") = 0 ) Then
CheckStringForSQL = false
Exit Function
End If
lstr = LCase(str)
' Check if the string contains any patterns in our
' black list
For Each s in BlackList
If ( InStr (lstr, s) <> 0 ) Then
CheckStringForSQL = true
Exit Function
End If
Next
CheckStringForSQL = false
End Function
Public Function CheckString (strEntrada)
Dim objRegExp
Set objRegExp = Server.CreateObject("VBScript.RegExp")
Dim strExpressao
strExpressao = "(<\s*/*(script|object|applet|embed|form|img)\s*.*>)" '< [/] script ou object ou applet ou embed ou form >
strExpressao = strExpressao & "|" & "(\s+eval\s*\()" ' EVAL(
strExpressao = strExpressao & "|" & "(\s+event\s*=)" ' Event=
strExpressao = Replace(strExpressao, "<", "(<|%60|<)") 'Garantir < ou < em HTML ENCODE
strExpressao = Replace(strExpressao, ">", "(>|%62|>)") 'Garantir > ou > em HTML ENCODE
objRegExp.IgnoreCase = True 'Ignorar caixa "ALTA" ou "baixa"
objRegExp.Global = False 'Para na hora que encontrar (velocidade)
objRegExp.Pattern = strExpressao 'Define a expressão
CheckString = objRegExp.Test(strEntrada) 'testa
Set objRegExp = Nothing
End Function
'''''''''''''''''''''''''''''''''''''''''''''''''''
'  Check forms data
'''''''''''''''''''''''''''''''''''''''''''''''''''
Dim s
For Each s in Request.Form
If ( CheckString(Request.Form(s)) ) Then
' Redirect to an error page
Response.Redirect(ErrorPage)
End If
Next
'''''''''''''''''''''''''''''''''''''''''''''''''''
'  Check query string
'''''''''''''''''''''''''''''''''''''''''''''''''''
For Each s in Request.QueryString
If ( CheckString(Request.QueryString(s)) ) Then
' Redirect to error page
Response.Redirect(ErrorPage)
End If
Next
'''''''''''''''''''''''''''''''''''''''''''''''''''
'  Check cookies
'''''''''''''''''''''''''''''''''''''''''''''''''''
For Each s in Request.Cookies
If ( CheckString(Request.Cookies(s)) ) Then
' Redirect to error page
Response.Redirect(ErrorPage)
End If
Next
'''''''''''''''''''''''''''''''''''''''''''''''''''
'  Add additional checks for input that your application
'  uses. (for example various request headers your app
'  might use)
'''''''''''''''''''''''''''''''''''''''''''''''''''
%>