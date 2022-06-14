<?if (DexteR!=1) exit;?>
<?
/*----------------------------------------------------------------------
Painel Player Versão 0.1
Desenvolvidor Por: Mak (sirmakloud@gmail.com)
Editado Por: Jiraya (richard.cva21@hotmail.com(
----------------------------------------------------------------------*/
require_once "config.php"; // or die ("");
function RandomPass($numchar){
   $letras = "A,B,C,D,E,F,G,H,I,J,K,1,2,3,4,5,6,7,8,9,0";
   $array = explode(",", $letras);
   shuffle($array);
   $senha = implode($array, "");
   return substr($senha, 0, $numchar);
}
$pgid = RandomPass(5);

            $qCharID=($_SESSION["charID"])?$_SESSION["charID"]:$_SESSION["ID"];

//------------------------------------------------------------ CREATE CHARACTER
            if($_POST[action]!="Criar Char")
            {
?>
            <form method="post" onSubmit="disabledBttn(this)" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>&pgid=$pgid">
                <input name="newchar" type="text" maxlength="15" class="form-control" placeholder="Nickname" style="max-width: 30%; display: inline;" >
				 <select name="class" size="1" id="nasc_mes" class="form-control"  style="max-width: 30%; display: inline;"/>
				<option value="Lutador">Lutador</option>
				<option value="Mecanico">Mecanico</option>
				<option value="Arqueira">Arqueira</option>
				<option value="Pike">Pike</option>
				<option value="Atalanta">Atalanta</option>
				<option value="Cavaleiro">Cavaleiro</option>
				<option value="Mago">Mago</option>
				<option value="Sacerdotisa">Sacerdotisa</option>
				
          	</select>
			<button value="submit" class="btn btn-default db" style="max-width: 20%;margin-left:10px;">Criar</button> 
            <input type="hidden" name="action" value="Criar Char">

            </form>	
			
<?

            }
            else
            {
            include_once("gravarchar.php");

                // Fill in 00 to left character
                $leftLen=10-strlen($qCharID);
                for($i=0;$i<$leftLen;$i++)
                {
                    $addOnLeft.=pack("h*",00);
                }
                $writeAccName=$qCharID.$addOnLeft;

                $charInfo=$dirUserInfo . ($func->numDir($qCharID)) . "/" . $qCharID . ".dat";

                if(!file_exists($charInfo))
                {
                    copy("criarchars/info.dat",$dirUserInfo . ($func->numDir($qCharID)) . "/" . $qCharID. ".dat");

                    $fRead=false;
                    $fOpen = fopen($charInfo, "r");
                    while (!feof($fOpen)) {
                    @$fRead = "$fRead" . fread($fOpen, filesize($charInfo) );
                    }
                    fclose($fOpen);

                    // Change character class ----------------------------------------------------------------
                    $sourceStr = substr($fRead, 0, 16) . $writeAccName . substr($fRead, 26);
                    $fOpen = fopen($charInfo, "wb");
                    fwrite($fOpen, $sourceStr, strlen($sourceStr));
                    fclose($fOpen);

                    echo "<br>Arquivo de ID Criado, AGORA CRIE SEU CHAR!";
					echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?sess=char'>";
                }
                else
                {
                    if( filesize($charInfo)==240)
                    {
                        $newName=trim($func->char_filter(trim($_POST["newchar"])),"\x00");

                        //Limpando Caracteres de acentos
                        function strace($a)
                        {
                        $a = eregi_replace("[àáâäã]","a",$a);
                        $a = eregi_replace("[èéêë]","e",$a);
                        $a = eregi_replace("[ìíîï]","i",$a);
                        $a = eregi_replace("[òóôöõ]","o",$a);
                        $a = eregi_replace("[ùúûü]","u",$a);
                        $a = eregi_replace("[ÀÁÂÄÃ]","A",$a);
                        $a = eregi_replace("[ÈÉÊË]","E",$a);
                        $a = eregi_replace("[ÌÍÎÏ]","I",$a);
                        $a = eregi_replace("[ÒÓÔÖÕ]","O",$a);
                        $a = eregi_replace("[ÙÚÛÜ]","U",$a);
                        $a = eregi_replace("ç","c",$a);
                        $a = eregi_replace("Ç","C",$a);
                        $a = eregi_replace("ñ","n",$a);
                        $a = eregi_replace("Ñ","N",$a);
                        $a = str_replace("´","",$a);
                        $a = str_replace("`","",$a);
                        $a = str_replace("¨","",$a);
                        $a = str_replace("^","",$a);
                        $a = str_replace("~","",$a);
                        return $a;
                        }
                        $newName = strace("$newName");

                        if(!$func->is_valid_string($newName))
                        {

                            $charDat = $dirUserData . ($func->numDir($newName)) . "/" . $newName . ".dat";
							$newcharclass = $_POST['class'];

                            if(!file_exists($charDat))
                            {
                                copy("criarchars/$newcharclass.dat",$dirUserData . ($func->numDir($newName)) . "/" . $newName. ".dat");

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
                                );

                                $chkEmpArr=array();
                                $chkChar=array();
                                foreach($charNameArr as $key=>$value)
                                {
                                    if(empty($value)) $chkEmpArr[]=$key;
                                    else $chkChar[]=$key;
                                }

                                if(count($chkChar)<5)
                                {

                                    // point to each information line
                                    $startPoint=$chkEmpArr[0];
                                    $endPoint=$startPoint+15;

                                     // Write info-----------------------------------------------------------------------
                                    $fRead=false;
                                    $fOpen = fopen($charInfo, "r");
                                    while (!feof($fOpen)) {
                                    @$fRead = "$fRead" . fread($fOpen, filesize($charInfo) );
                                    }
                                    fclose($fOpen);

                                    // Fill in 00 to left character
                                    $addOnLeft=false;
                                    $leftLen=15-strlen($newName);
                                    for($i=0;$i<$leftLen;$i++)
                                    {
                                        $addOnLeft.=pack("h*",00);
                                    }
                                    $writeName=$newName.$addOnLeft;


                                    $sourceStr = substr($fRead, 0, $startPoint) . $writeName . substr($fRead, $endPoint);
                                    $fOpen = fopen($charInfo, "wb");
                                    fwrite($fOpen, $sourceStr, strlen($sourceStr));
                                    fclose($fOpen);

                                    // Write data-------------------------------------------------------------------------
                                    $fRead=false;
                                    $fOpen = fopen($charDat, "r");
                                    while (!feof($fOpen)) {
                                    @$fRead = "$fRead" . fread($fOpen, filesize($charDat) );
                                    }
                                    fclose($fOpen);

                                    $bin = $func->char2Num($_POST["class"]);
                                    $bina= pack("h*",$bin);

                                    // Change character class ----------------------------------------------------------------
                                   $sourceStr = substr($fRead, 0, 16) . $writeName . substr($fRead, 31);
						$fOpen = fopen($charDat, "wb");
						fwrite($fOpen, $sourceStr, strlen($sourceStr));
						fclose($fOpen);

						//alterando login
						$fRead=false;
						$fOpen = fopen($charDat, "r");
						while (!feof($fOpen)) {
							@$fRead = "$fRead" . fread($fOpen, filesize($charDat) );
						}
						fclose($fOpen);

						$sourceStr = substr($fRead, 0, 704) . $writeAccName . substr($fRead, 714);
						$fOpen = fopen($charDat, "wb");
						fwrite($fOpen, $sourceStr, strlen($sourceStr));
						fclose($fOpen);


                           echo "<br>Personagem criado com sucesso! $nomechar, level 100.";
						   echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
                                }
                                else
                                {
                                    echo "<br>Você so pode ter até 5 personagens em cada CONTA!";
									echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=index.php'>";
                                }
                            }
                            else
                            {
                                echo "<br>Este nome já está sendo utilizado por outro jogador. Volte e tente novamente.";
								echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=index.php?sess=char'>";
                            }

                        }
                        else
                        {
                            echo "<br>Nick que você escolheu não pode ser utilizado desculpe, volte e tente novamente!";
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=index.php?sess=char'>";
                        }


                    }
                    else
                    {
                        echo "<br>Arquivo COMRROMPIDO!";
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=index.php'>";
                    }
                }

            }




//------------------------------------------------------------ DELETE CHARACTER
        if($_SESSION["charDir"])
        {
            if($_POST[action]!="Apagar Char")
            {
?>
<?

            }
            else
            {

                include_once("consultachar.php");
                if (!$naodeleta)
                {


                $charInfo=$dirUserInfo . ($func->numDir($qCharID)) . "/" . $qCharID . ".dat";

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

                $chkCharLine=array();
                foreach($charNameArr as $key=>$value)
                {
                    if($_SESSION["charName"]==$value) $chkCharLine[]=$key;
                }


                // Fill in 00 to left character
                $addOnLeft=false;
                for($i=0;$i<15;$i++)
                {
                    $addOnLeft.=pack("h*",00);
                }

                $startPoint=$chkCharLine[0];
                $endPoint=$startPoint+15;

                $fRead=false;
                $fOpen = fopen($charInfo, "r");
                while (!feof($fOpen)) {
                @$fRead = "$fRead" . fread($fOpen, filesize($charInfo) );
                }
                fclose($fOpen);

                $sourceStr = substr($fRead, 0, $startPoint) . $addOnLeft . substr($fRead, $endPoint);
                $fOpen = fopen($charInfo, "wb");
                fwrite($fOpen, $sourceStr, strlen($sourceStr));
                fclose($fOpen);

                copy($dirUserData . ($func->numDir($_SESSION["charName"])) . "/" . $_SESSION["charName"] . ".dat" ,$dirUserDelete . "/" . $_SESSION["charName"] . ".dat");
                unlink($dirUserData . ($func->numDir($_SESSION["charName"])) . "/" . $_SESSION["charName"] . ".dat");

                echo "<br>O Personagem <b>". $_SESSION["charName"] ."</b> FOI (DELETADO) com sucesso!";
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=index.php'>";

                $_SESSION["charDir"]='';
                $_SESSION["charNum"]='';
                $_SESSION["charID"]='';
                $_SESSION["charName"]='';
                $_SESSION["charLevel"]='';
                $_SESSION["charClass"]='';

                }
                else
                {
                 echo "<br>$nomechar FOI CRIADO HOJE, PORTANTO TEM O PRAZO DE 1 DIA NO MINIMO PARA PODER SER DELETADO!";
                 echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=index.php'>";
                }

            }
        }

?>