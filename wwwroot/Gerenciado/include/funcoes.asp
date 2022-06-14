<%
function Bug(Valor)
		response.Write Valor
		response.end
End Function
	
function RW(Valor)
		response.Write Valor
End Function

Function numDir(name)
	dim total, i
	total = 0
	For i=1 To Len(name)
		total = total + Asc(UCase(Mid(name, i, 1)))
		If total >= 256 Then
			total = total - 256
		End If
	Next
	numDir = total
End Function

Function FormataCreditos(CT)

	If Len(CT) = 1 Or Len(CT) = 2 Or Len(CT) = 3 Then
		FormataCreditos = "R$ "&CT
	ElseIf Len(CT) >= 4 Then
		FormataCreditos = "R$ "&Mid(CT,1,1) & "." & Mid(CT,2,4)
	ElseIf Len(CT) >= 5 THen
		FormataCreditos = "R$ "&Round(Mid(CT,1,2)) & "." & Round(Mid(CT,3,10))
	End If

End Function 

Function FormataMinutos(CT)

	If Len(CT) = 1 Or Len(CT) = 2 Or Len(CT) = 3 Then
		FormataMinutos = CT
	ElseIf Len(CT) >= 4 Then
		FormataMinutos = Mid(CT,1,1) & "." & Mid(CT,2,4)
	ElseIf Len(CT) >= 5 THen
		FormataMinutos = Round(Mid(CT,1,2)) & "." & Round(Mid(CT,3,10))
	End If

End Function 

%>