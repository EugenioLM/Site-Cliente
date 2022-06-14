<?
header("Content-type:text/html;charset=UTF-8");
?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?if (DexteR!=1) exit;?>
<?
$username=$_SESSION["ID"];
$pasta = $func->numDir($username);
//Pasta de entrega
$pasta_entrega = $rootDir."PostBox/$pasta/$username.dat";

$ip = $_SERVER["REMOTE_ADDR"];

//Verifica número de suportes em analise

$connection = odbc_connect( $connection_string, $user, $pass );
$query = "SELECT * FROM [Dexter].[dbo].[Suporte] WHERE [stats]='1' ";
$q = odbc_exec($connection, $query);

$zz =0;
while($suporte = odbc_fetch_array($q)){ $zz++; }

if ($zz >= 50) {
?>
<?
} else {

//Verifica quantos pedidos de suporte o player já enviou
$connection = odbc_connect( $connection_string, $user, $pass );
$query_contasup = "SELECT * FROM [Dexter].[dbo].[Suporte] WHERE [idplayer]='$username' AND [stats]='1'";
$q_contasup = odbc_exec($connection, $query_contasup);

$contasuporte = 0;
while($suporte_conta = odbc_fetch_array($q_contasup)){ $contasuporte++; }


?>
<h4 class="title text-left"><span class="fa fa-angle-right"></span> Suporte</h4><hr />  
<center>
<b>Sobre Pedidos de Restaure</b><br/>
A restauração de Item(s) é realizada com base nas informações contidas em seu pedido, portanto de o maior número de detalhes que puder e jamais invente falsos pedidos, que com certeza receberá a devida punição.<br/><br/>
<b>Limite de Pedidos de Suporte</b><br/>
O player poderá enviar um pedido por vez ao sistema de suporte, pois muitos player estavam enviando o mesmo pedido diversas vezes sobre o mesmo caso, com isso nosso sistema ficava lotado com o mesmo pedido e atrapalhava o sistema de restaure, assim deverá aguardar o seu caso ser resolvido para ai sim fazer novo pedido.
<br/><br/>
<b>Casos que não tem Restaure</b><br/>
Contas de players com Share, ou seja mais de uma pessoa utilizando a mesma conta.
Itens que tiverem sumido a mais de 7 dias.
Venda de Itens em shop .
Itens emprestados a outro player.
Itens entregues a outro player por sua livre e espontânea vontade. 
Itens de graça nos NPC's do game.
Pedidos de restaure só podem ser feitos diretamente pela conta do player que possui o personagem que tenha o problema, pedidos de ajuda de outras contas de ajuda a amigos ou de outras contas do mesmo player serão dadas como negadas.
Itens de contas Hackeadas mais de uma vez em menos de 10 dias não são restaurados.
Restaure de itens somente com o ID principal do donate,caso você ganhou ou recebeu o item e quer restaure, sera negado/perdeu o item infelizmente não damos restaures,somente se vier do player donatado.<br/><br/>
<b>Casos que não tem Restaure</b><br/>
Favor informar a data do ultimo age dado ex: dei age dia 20/06 no item "x" e perdi ele no dia 30/06,caso não informe o dia do ultimo age ,não será analisado o caso.<br/><br/><hr/>
<center>
<h4 class="title text-left">Fórmulário de Pedidos de Suporte</h4><br/><br/>
<?
        if($_POST[acao]!="Enviar")
        {
?>
          <form name="suporte" method="post" onSubmit="disabledBttn(this)" action="index.php?sess=abresuporte">
<div class="row">
									<div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Selecione o Char que deseja pedido de suporte</label><br>
                                                <select name="nickchar" id="personagem"class="form-control">
                    <?
          $qNickCharID=($_SESSION["charID"])?$_SESSION["charID"]:$_SESSION["ID"];
          $charInfo=$dirUserInfo . ($func->numDir($qNickCharID)) . "/" . $qNickCharID . ".dat";

          if(file_exists($charInfo) && ( filesize($charInfo)==240) )
          {
          	$fRead=false;
          	$fOpen = fopen($charInfo, "r");
          	$fRead =fread($fOpen,filesize($charInfo));
          	@fclose($fOpen);

          	// list char information
          	$charNameArr=array(
          	"48" => trim(substr($fRead,0x30,15),"\x00"),
          	"80" => trim(substr($fRead,0x50,15),"\x00"),
          	"112"=> trim(substr($fRead,0x70,15),"\x00"),
          	"144"=> trim(substr($fRead,0x90,15),"\x00"),
          	"176"=> trim(substr($fRead,0xb0,15),"\x00"),
			"208"=> trim(substr($fRead,0xd0,15),"\x00"),
          	);

          	if(count($charNameArr)>0)
          	{
          		foreach($charNameArr as $key=>$value)
          		{
          			$expValue=explode("\x00",$value);
          			if($expValue[0]!=""){ echo "<option >".$expValue[0]."</option>"; }
          		}
          	}
          	else
          	{
          		echo "EMPTY";
          	}

          }
          else
          {
          	echo "EMPTY";
          }

?>
                </select>
												
                                            </div>
                                        </div>									
									</div><br/>
									
<div class="row">
									<div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Data do Ocorrido</label><br>
												<select name="dia1">
                        <option selected="selected" value="<?php echo date("d"); ?>"><?php echo date("d"); ?></option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>
/
<select name="mes1" id="mes1">
  <option selected="selected" value="<?php echo date("m"); ?>"><?php echo date("m"); ?></option>
  <option value="02">2</option>
  <option value="03">3</option>
  <option value="04">4</option>
  <option value="05">5</option>
  <option value="06">6</option>
  <option value="07">7</option>
  <option value="08">8</option>
  <option value="09">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
</select>
/
<select name="ano1" id="ano1">
  <option value="<?php echo date("Y"); ?>" selected="selected"><?php echo date("Y"); ?></option>
  <option value="2010">2018</option>
</select>
												
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hora do Ocorrido</label><br>
                                                <select name="hora1" id="hora1">
    <option value="00" selected>00</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="09">08</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
  </select>
  :
  <select name="minuto1" id="minuto1">
    <option selected="selected" value="00">00</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
    <option value="32">32</option>
    <option value="33">33</option>
    <option value="34">34</option>
    <option value="35">35</option>
    <option value="36">36</option>
    <option value="37">37</option>
    <option value="38">38</option>
    <option value="39">39</option>
    <option value="40">40</option>
    <option value="41">41</option>
    <option value="42">42</option>
    <option value="43">43</option>
    <option value="44">44</option>
    <option value="45">45</option>
    <option value="46">46</option>
    <option value="47">47</option>
    <option value="48">49</option>
    <option value="50">50</option>
    <option value="51">51</option>
    <option value="52">52</option>
    <option value="53">53</option>
    <option value="54">54</option>
    <option value="55">55</option>
    <option value="56">56</option>
    <option value="57">57</option>
    <option value="58">58</option>
    <option value="59">59</option>
  </select>
												
                                            </div>
											
                                        </div>
										
									</div><br/>
<div class="row">
									<div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Setor</label><br/>
                                                <select name="setor" class="form-control">
                    <option selected>Selecione</option>
                    <option value="1">Restaure de Itens</option>
                    <option value="2">Restaure de Conta</option>
                    <option value="3">Denunciar Player</option>
                    <option value="4">Denunciar Fraudes</option>
		            <option value="5">Esclarecer Duvidas</option>
		            <option value="6">Duvida Donate</option>
		                     </select>
												
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Assunto</label>
                                                <input name="assunto" type="text" id="assunto" size="50" maxlength="50"class="form-control"/>
												
                                            </div>
                                        </div>
										
									</div><br/>
<div class="row">
									<div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Resumo do Ocorrido</label>
                                                <textarea name="resumo" cols="50" rows="4" id="resumo"class="form-control"></textarea>
												<strong>Atenção: Nos textos não utilize nenhum Caráter escreva somente textos, se escrever símbolos ou caracteres especiais o sistema não vai aceitar sua mensagem.
												
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Prejuízo causado</label>
                                                <textarea name="preju" cols="50" rows="4" id="preju"class="form-control"></textarea>
												<strong>Imagens hospedar no site: <a href="https://uploaddeimagens.com.br/" target="_blank">www.uploaddeimagens.com.br</a> e colocar o link dentro do resumo do ocorrido.
                                            </div>
                                        </div>
										
									</div>

<input name="acao" type="submit" id="acao" value="Enviar"class="btn btn-primary">
<input name="acao" type="hidden" id="acao" value="Enviar"></td>
<br/><br/>
          <?
        }
        if($_POST[acao]=="Enviar")
        {


if ($contasuporte >= 1) {
echo "<p><br><p><center><b>Você está com um Pedido de Suporte já enviado, espere que seu último pedido seja Concluído para que possa enviar um novo!</b><p><br><p>";
} else {

if ($nickchar2) {  $nickchar = stripslashes($_POST['nickchar2']); } else { $nickchar = stripslashes($_POST['nickchar']); }
$dia1 = stripslashes($_POST['dia1']);
$mes1 = stripslashes($_POST['mes1']);
$ano1 = stripslashes($_POST['ano1']);
$hora1 = stripslashes($_POST['hora1']);
$minuto1 = stripslashes($_POST['minuto1']);
$assunto = stripslashes($_POST['assunto']);
$resumo = stripslashes($_POST['resumo']);
$preju = stripslashes($_POST['preju']);
$setor = stripslashes($_POST['setor']);
$dia1 = strip_tags($dia1);
$mes1 = strip_tags($mes1);
$ano1 = strip_tags($ano1);
$hora1 = strip_tags($hora1);
$minuto1 = strip_tags($minuto1);
$assunto = strip_tags($assunto);
$resumo = strip_tags($resumo);
$preju = strip_tags($preju);
$setor = strip_tags($setor);
$data = date("d-m-Y");

$resumo = trim(str_replace("\r\n"," ",$resumo));
$resumo = addslashes($resumo);

$preju = trim(str_replace("\r\n"," ",$preju));
$preju = addslashes($preju);


if (!$dia1 OR !$mes1 OR !$ano1 OR !$hora1 OR !$minuto1 OR !$setor OR !$assunto OR !$resumo OR !$preju) {
echo "<p><br><p><center><b>Você precisa preenhcer todos os campos do Formulário de Suporte!</b><p><br><p>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=?sess=abresuporte'>";

} else {

if (anti_sqlSuporte($minuto1) != 0 || anti_sqlSuporte($char) != 0 || anti_sqlSuporte($dia1) != 0 || anti_sqlSuporte($mes1) != 0 ||

anti_sqlSuporte($ano1) != 0 ||   anti_sqlSuporte($setor) != 0 ||

anti_sqlSuporte($assunto) != 0 || anti_sqlSuporteTXT($resumo) != 0 || anti_sqlSuporteTXT($preju) != 0) {
echo "<p><br><p><center><b>Você está utilizando algum caracter não autorizado pro nosso sistema, preencha novamente!</b><p><br><p>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=?sess=abresuporte'>";
} else {

$horaJ1 = "$hora1:$minuto1";

//Stats: 1 = Enviado / 2 = Em Andamento / 3 = Completado
		$connection = odbc_connect( $connection_string, $user, $pass );
		$query = "INSERT INTO [Dexter].[dbo].[Suporte]

([setor],[idplayer],[char],[dia1],[mes1],[ano1],[hora1],[assunto],[resumo],[preju],[data],[stats],[IP],[UltimaResp]) VALUES
('$setor','$username','$nickchar','$dia1','$mes1','$ano1','$horaJ1','$assunto','$resumo','$preju','$data','1','$ip','GM')";
		$q = odbc_exec($connection, $query);

echo "<p><br><p><center><b>Seu Pedido de Suporte foi enviado a Equipe GM.</b><p><br><p>";
echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=?sess=listasuporte'>";

        }}}}

?>        </td>
      </tr>
    </table>
    </td>
  </tr>
</table>

<?php } ?>