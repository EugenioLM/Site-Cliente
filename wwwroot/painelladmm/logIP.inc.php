<?if (PT!=1) exit;?>
<?php
if($_POST[acao]!="logs")
{
?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
  <form method="post" onSubmit="disabledBttn(this)" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>">
	<table background="imgs/fundo_textura1.gif" width="722" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="722"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">
                  <tr>
                    <td colspan="2" align="center" bgcolor="#000000"><b><font color="#FFFFFF">Busca de Log's por IP</font></b></td>
                  </tr>
<tr>
  <td width="35%" align="right"><strong><font color="#000000">IP do Player </font></strong></td>
  <td width="65%">                      <input type="text" name="ip" /> </td>
                </tr>
<tr>
<td align="right"><strong>A��o</strong></td>
<td><select name="tipo">
              <option value="0">Item pego do ch�o</option>
              <option value="2">Recebeu Item/Gold em trade</option>
              <option value="3">Mixagem completa</option>
              <option value="4">Item ainda para maturar(Age)</option>
              <option value="5">Item comprado do NPC</option>
              <option value="6">Item dropado no ch�o</option>
              <option value="7">Item vendido no NPC</option>
			  <option value="8">Item/Gold passado em trade</option>
			  <option value="9">Item colocado no Mix</option>
 			  <option value="10">Item colocado no age</option>
			  <option value="12">Item j� maturado</option>
			  <option value="22">Gold Recebido em loja/ Item comprado em loja</option>			  
			  <option value="23">Vendeu item em loja/ Comprou em loja(gold)</option>
			  <option value="24">Force Orb Usado</option>
			  <option value="25">Shelton colocado no Orb Master</option>
			  <option value="26">Force Orb completo</option>
		  </select></td>
</tr>


                  <tr>
                  <td colspan="2" align="center"><input name="submit2" type="submit" class="button6" value="Procurar" />
                    <input name="acao" type="hidden" id="acao" value="logs" /></td>
                  </tr>
                <tr>
                  <td colspan="2" align="center"><div align="left">
                    <p><strong>Instru&ccedil;&otilde;es de como Utilizar o Sistema de Busca de logs por IP<br>
                    <strong>Exemplo</strong>: voc�, quer fazer uma verifica��o de ip informe o ip exemplo 192.168.1.100<br>
                    </strong>1 Passo - Digite o IP do Player que voc� deseja verificar os logs.<br> 
                    2 Passo - Em a��o escolha a a��o que voc� deseja ficar informado.<br>
                   <strong>Exemplos</strong>: Item pego do ch�o, se ele pegou item do ch�o, mostra se n�o foi de ninguem que dropou dia hora, etc..<br>
                    3 Passo - Clique em Procurar<br /></p></div></td>
                  </tr>
                </table></td>
              </tr>
  </table>
           </form>
<?php
}
else
{
$username = $_POST['ip'];
$tipo = $_POST['tipo'];
$tipo = trim($tipo);

				//Verificando se Existe essa ID
				$connection = odbc_connect( $connection_string, $user, $pass );
                $query = "SELECT * FROM [ITEMLogDB].[dbo].[IL]  WHERE [IP]='$username' and [Flag]='$tipo' " ;
                $q = odbc_exec($connection, $query);
                $qt = odbc_do($connection, $query);

            while(odbc_fetch_row($qt)){
			$order=odbc_result($qt,1);
		    $UserID=odbc_result($qt,2);
		    $CharName=odbc_result($qt,3);
            $IP=odbc_result($qt,4);
            $flag=odbc_result($qt,5);
            $TUserID=odbc_result($qt,6);
		    $TCharName=odbc_result($qt,7);
	        $TMoney=odbc_result($qt,8);
		    $TIP=odbc_result($qt,9);
		    $COD1=odbc_result($qt,13);
		    $COD2=odbc_result($qt,12);
	        $data=odbc_result($qt,14);
			
$goldkk = $TMoney/1000000;	
if ($flag == "0") { $txtflag = "Item pego do ch�o";	}
if ($flag == "2") { $txtflag = "Recebeu Item/Gold em trade";	}
if ($flag == "3") { $txtflag = "Mixagem completa";	}
if ($flag == "4") { $txtflag = "Item ainda para maturar(Age)";	}
if ($flag == "5") { $txtflag = "Item comprado do NPC";	}
if ($flag == "6") { $txtflag = "Item dropado no ch�o";	}
if ($flag == "7") { $txtflag = "Item vendido no NPC";	}
if ($flag == "8") { $txtflag = "Item/Gold passado em trade";	}
if ($flag == "9") { $txtflag = "Item colocado no Mix";	}
if ($flag == "10") { $txtflag = "Item colocado no age";	}
if ($flag == "12") { $txtflag = "Item j� maturado";	}
if ($flag == "22") { $txtflag = "Gold Recebido em loja/ Item comprado em loja";	}
if ($flag == "23") { $txtflag = "Vendeu item em loja/ Comprou em loja(gold)";	}
if ($flag == "24") { $txtflag = "Force Orb Usado";	}
if ($flag == "25") { $txtflag = "Shelton colocado no Orb Master";	}
if ($flag == "26") { $txtflag = "Force Orb completo";	}

if ($flag <> "0" AND $flag <> "2" AND $flag <> "3" AND $flag <> "5" AND $flag <> "7" AND $flag <> "6" AND $flag <> "8" AND $flag <> "9" AND $flag <> "10" AND $flag <> "12" AND $flag <> "22" AND $flag <> "23" AND $flag <> "24" AND $flag <> "25" AND $flag <> "26") { $txtflag = $flag;	}
            if ($q && $qt)
            	{
?>
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#330099">
<tr>
<td width="6%" align="center" bgcolor="#000000"><font color="#FFFFFF">Ordem</font></td>
<td width="6%" align="center" bgcolor="#000000"><font color="#FFFFFF">ID</font></td>
<td width="3%" align="center" bgcolor="#000000"><font color="#FFFFFF">Nick</font></td>
<td width="3%" align="center" bgcolor="#000000"><font color="#FFFFFF">IP</font></td>
<td width="14%" align="center" bgcolor="#000000"><font color="#FFFFFF">A&ccedil;&atilde;o</font></td>
<td width="9%" align="center" bgcolor="#000000"><font color="#FFFFFF">ID quem recebeu </font></td>
<td width="10%" align="center" bgcolor="#000000"><font color="#FFFFFF">Nick quem recebeu </font></td>
<td width="6%" align="center" bgcolor="#000000"><font color="#FFFFFF">Gold</font></td>
<td width="9%" align="center" bgcolor="#000000"><font color="#FFFFFF">IP quem recebeu </font></td>
<td width="12%" align="center" bgcolor="#000000"><font color="#FFFFFF">C&oacute;digo do Item(Baixo)</font></td>
<td width="11%" align="center" bgcolor="#000000"><font color="#FFFFFF">C&oacute;digo do Item(Cima) </font></td>
<td width="11%" align="center" bgcolor="#000000"><font color="#FFFFFF">Data</font></td>
</tr>
<tr>
<td align="center"><? echo $order; ?>&nbsp;</td>
<td align="center"><? echo $UserID; ?>&nbsp;</td>
<td align="center"><? echo $CharName; ?>&nbsp;</td>
<td align="center"><? echo $IP; ?>&nbsp;</td>
<td align="center"><? echo $txtflag; ?>&nbsp;</td>
<td align="center"><? echo $TUserID; ?>&nbsp;</td>
<td align="center"><? echo $TCharName; ?>&nbsp;</td>
<td align="center"><? echo $goldkk; ?> kk</td>
<td align="center"><? echo $TIP; ?>&nbsp;</td>
<td align="center"><? echo $COD2; ?>&nbsp;</td>
<td align="center"><? echo $COD1; ?>&nbsp;</td>
<td align="center"><? echo $data; ?>&nbsp;</td>
</tr>
</table>
<?
} }	} 
?>

