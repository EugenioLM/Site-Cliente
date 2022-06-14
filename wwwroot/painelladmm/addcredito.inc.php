<?
if (PT!=1)  exit;
if($_SESSION['permissao'] < 3){
echo "Você não tem permissão para acessar esta área";
exit;
}
?>
</style>
<link href="css/style.css" rel="stylesheet" type="text/css">
<table background="imgs/fundo_textura1.gif">
              
                  
<link href="style.css" rel="stylesheet" type="text/css">
<body background="background.gif">
<form id="form1" name="form1" method="post" action="">
<table background="imgs/fundo_textura1.gif" width="712" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="712"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">
                  <tr>
                    <td colspan="2" align="center" bgcolor="#000000"><b><font color="#FFFFFF">Adicionar creditos direto ao Shop</span></th>
    </tr>
<table background="imgs/fundo_textura1.gif" width="716" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="716"><table width="80%" border="0" align="center" cellpadding="4" cellspacing="2">
                
<form id="form1" name="form1" method="post" action="">
  <table width="580" height="110" border="0">
    <tr>
      <td valign="top"><table width="575" height="84" border="0" align="center">
        <tr>
          <td width="158" height="25">ID da conta</td>
          <td width="407"><label>
            <input type="text" name="id" id="id" />
            </label></td>
          </tr>
        <tr>
          <td height="26">Cr&eacute;ditos a adicionar</td>
          <td><label>
            <input type="text" name="creditos" id="creditos" />
            </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label>
            <input type="submit" name="button" id="button" class="button6" value="Adicionar" />
            <input name="acao" type="hidden" id="acao" value="envia" />
            </label></td>
          </tr>
          <tr>
                  <td colspan="2" align="center"><div align="left">
                    <p><strong>Instru&ccedil;&otilde;es de como usar o sistema de adicionar cr&eacute;dito em uma conta.<br>
                    </strong>1 Passo - Localize os campos branco acima.<br> 
                    2 Passo - No campos em branco coloque o id do player que voc&ecirc; deseja por os cr&eacute;ditos, e no campo de baixo coloque a quantidade de cr&eacute;ditos que voc&ecirc; deseja adicionar na conta.<br>
                    3 Passo - Clique em Adicionar.</p>
                    <p>Apos seguir os 3 passos acima, e clicar em adicionar vai abrir abrir uma mensagem falando.<BR>
                    qual a&ccedil;&atilde;o que deu, se foi adicionado com sucesso, ou n&atilde;o etc...</p>
</div>
                  </div></td>
                  </table>
                  </tr>
        </table>
        <br />
        <table width="642" height="27" border="0" align="center">
          <tr>
            <td><?php 
		  if($_POST['acao'] == "envia"){
		  $id = $_POST['id'];
		  $creditos = $_POST['creditos'];
		  $arquivo = "$pastapainel/shop/bonusplayer/$id.arc";
		  if(empty($id) || empty($creditos)){
		  echo"<center><script>
		  alert('Preencha todos os campos!!!');
		  history.go(-1);
		  </script>";
		  }else{
		  if(!file_exists($arquivo)){
		  echo"<center><b><font color='red'>o arquivo de b&ocirc;nus da conta n&atilde;o existe!!!</b></font>";
		  }else{
$abre = fopen($arquivo,"r");
$saldo_atual = fread($abre,filesize($arquivo));
fclose($abre);

$abre2 = fopen($arquivo,"w");
$novos_creditos = $saldo_atual + $creditos;
$atualiza_saldo = fwrite($abre2,$novos_creditos);

if($atualiza_saldo == true){
echo"<b><center><font color='green'>Pronto!,os cr&eacute;ditos foram adicionados a conta <u>$id</b></font>";
}else{
echo"<b><center><font color='red'>Erro ao adicionar os cr&eacute;ditos</b></font>";
}

}
}
}

		  ?></td>
            </tr>
          </table>
    
  </table>
