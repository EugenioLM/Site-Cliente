<%
	Session.Abandon()
%>

<script type="text/javascript">
window.onload=function()
{
	alert("Ops! Sua sessao expirou, entre com seus dados novamente.");
	location.href='default.asp';	
}
</script>