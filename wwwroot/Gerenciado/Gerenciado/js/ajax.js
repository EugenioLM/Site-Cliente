	function createXMLHTTP() 
	{
		var ajax;
		try 
		{
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch(e) 
		{
			try 
			{
				ajax = new ActiveXObject("Msxml2.XMLHTTP");
				alert(ajax);
			}
			catch(ex) 
			{
				try 
				{
					ajax = new XMLHttpRequest();
				}
				catch(exc) 
				{
					 alert("Esse browser n?o tem recursos para uso do Ajax");
					 ajax = null;
				}
			}
			return ajax;
		}
	
	
		   var arrSignatures = ["MSXML2.XMLHTTP.5.0", "MSXML2.XMLHTTP.4.0",
							    "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP",
							    "Microsoft.XMLHTTP"];
		   for (var i=0; i < arrSignatures.length; i++) 
		   {
				try 
				{
					var oRequest = new ActiveXObject(arrSignatures[i]);
					return oRequest;
				} 
				catch (oError) 
				{
			    }
		   }
		
			   throw new Error("MSXML is not installed on your system.");
	}
