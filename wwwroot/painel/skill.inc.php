<? if (DexteR!=1) exit;
include_once "injection.php";
?>
<hr>
<?

        if($_SESSION["charLevel"]<90)
        {
           echo "<div class='alert alert-danger text-center'>
<span><b> MundialPK - </b> &Eacute; obrigat&oacute;rio que seu personagem tenha mais que level 90 para
ter acesso ao nosso sistema de altera&ccedil;&atilde;o e distribui&ccedil;&atilde;o de Skills !</span>
<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";
        }
        else
        {
            $fOpen = fopen($_SESSION["charDir"], "r");
            $fRead =fread($fOpen,4096);

            @fclose($fOpen);

            // details
            $tier0_1 = ord(substr($fRead,0x1fd,2));
            $tier0_2 = ord(substr($fRead,0x1fe,2));
            $tier0_3 = ord(substr($fRead,0x1ff,2));
            $tier0_4 = ord(substr($fRead,0x200,2));

            $tier1_1 = ord(substr($fRead,0x201,2));
            $tier1_2 = ord(substr($fRead,0x202,2));
            $tier1_3 = ord(substr($fRead,0x203,2));
            $tier1_4 = ord(substr($fRead,0x204,2));

            $tier2_1 = ord(substr($fRead,0x205,2));
            $tier2_2 = ord(substr($fRead,0x206,2));
            $tier2_3 = ord(substr($fRead,0x207,2));
            $tier2_4 = ord(substr($fRead,0x208,2));

            $tier3_1 = ord(substr($fRead,0x209,2));
            $tier3_2 = ord(substr($fRead,0x20A,2));
            $tier3_3 = ord(substr($fRead,0x20B,2));
            $tier3_4 = ord(substr($fRead,0x1fc,2));

            $defaultSP=$func->checkSkillPoints($_SESSION["charLevel"],'SP');
            $defaultEP=$func->checkSkillPoints($_SESSION["charLevel"],'EP');

            $totalSP=$tier0_1+$tier0_2+$tier0_3+$tier0_4+
            $tier1_1+$tier1_2+$tier1_3+$tier1_4+
            $tier2_1+$tier2_2+$tier2_3+$tier2_4;

            $totalEP=$tier3_1+$tier3_2+$tier3_3+$tier3_4;

            if ($_SESSION["charClass"]=="Lutador")
            {
            	$src="imgs/skill/fs/";

				$t0_1="Meele Mastery";
				$t0_2="Fire Attribute";
				$t0_3="Raving";
				$t0_4="Impact";

				$t1_1="Tripple Impact";
				$t1_2="Brutal Swing";
				$t1_3="Roar";
				$t1_4="Rage Zecram";

				$t2_1="Concentration_";
				$t2_2="Avenging Crash";
				$t2_3="Swift Axe";
				$t2_4="Bone Crash";

				$t3_1="Destroyer_";
				$t3_2="Berserker_";
				$t3_3="Cyclone Strike";
				$t3_4="Boost Health";

            }
        	elseif ($_SESSION["charClass"]=="Mecanico")
            {

            	$src="imgs/skill/ms/";

				$t0_1="Extreme Shield";
				$t0_2="Mechanic Bomb";
				$t0_3="Poison Attribute";
				$t0_4="Physical Absorbtion";

				$t1_1="Great Smash";
				$t1_2="Maximize";
				$t1_3="Automation";
				$t1_4="Spark";

				$t2_1="Metal Armor";
				$t2_2="Grand Smash";
				$t2_3="Mechanic Mastery";
				$t2_4="Spark Shield";

				$t3_1="Impulsion";
				$t3_2="Compulsion";
				$t3_3="Magnetic Sphere";
				$t3_4="Metal Golem";


            }
        	elseif ($_SESSION["charClass"]=="Arqueira")
            {

            	$src="imgs/skill/as/";

				$t0_1="Scout Hawk";
				$t0_2="Shooting Mastery";
				$t0_3="Wind Arrow";
				$t0_4="Perfect  Aim";

				$t1_1="Dion's Eye";
				$t1_2="Falcon";
				$t1_3="Arrow Of Rage";
				$t1_4="Avalanche";

				$t2_1="Elemental Shot";
				$t2_2="Golden Falcon";
				$t2_3="Bomb Shot";
				$t2_4="Perforation";

				$t3_1="Wolverine";
				$t3_2="Evasion Master";
				$t3_3="Phoenix Shot";
				$t3_4="Force Of Nature";

            }
        	elseif ($_SESSION["charClass"]=="Pike")
            {

            	$src="imgs/skill/ps/";

				$t0_1="Pike Wind";
				$t0_2="Ice Attriute";
				$t0_3="Critical Hit";
				$t0_4="Jumping Crash";

				$t1_1="Ground Pike";
				$t1_2="Tornado";
				$t1_3="Block Mastery";
				$t1_4="Expansion";

				$t2_1="Venom Spear";
				$t2_2="Vanish";
				$t2_3="Critical Mastery";
				$t2_4="Chain Lance";

				$t3_1="Assasin's Eye";
				$t3_2="Charging Strike";
				$t3_3="Vague";
				$t3_4="Shadow Master";

            }
        	elseif ($_SESSION["charClass"]=="Atalanta")
            {

            	$src="imgs/skill/at/";

				$t0_1="Shield Strike";
				$t0_2="Farina";
				$t0_3="Throwing Mastery";
				$t0_4="Vigor Spear";

				$t1_1="Windy";
				$t1_2="Twisted Javelin";
				$t1_3="Soul Sucker";
				$t1_4="Fire Javelin";

				$t2_1="Split Javelin";
				$t2_2="Trimph Of Valhalla";
				$t2_3="Light Javelin";
				$t2_4="Storm Javelin";

				$t3_1="Hall Of Valhalla";
				$t3_2="Extreme Rage";
				$t3_3="Frost Javelin";
				$t3_4="Vengeance";

            }
        	elseif ($_SESSION["charClass"]=="Cavaleiro")
            {

            	$src="imgs/skill/ks/";

				$t0_1="Sword Blast";
				$t0_2="Holy Body";
				$t0_3="Physical Training";
				$t0_4="DoubleCrash";

				$t1_1="HolyValor";
				$t1_2="Brandish";
				$t1_3="Piercing";
				$t1_4="Drastic Spirit";

				$t2_1="Sword Mastery";
				$t2_2="Devine Shield";
				$t2_3="Holy Incantation";
				$t2_4="Grand Cross";

				$t3_1="Sword Of Lisk";
				$t3_2="Godly Shield";
				$t3_3="God's Blessing";
				$t3_4="Divine Piercing";

            }
        	elseif ($_SESSION["charClass"]=="Mago")
            {

            	$src="imgs/skill/mgs/";

				$t0_1="Agony";
				$t0_2="Fire Bolt";
				$t0_3="Zenith_";
				$t0_4="Fire Ball";

				$t1_1="Mental Mastery";
				$t1_2="Waternado_";
				$t1_3="Enchant Weapon";
				$t1_4="Death Ray";

				$t2_1="Enery Shield";
				$t2_2="Diastrophism_";
				$t2_3="Spirit Elemental";
				$t2_4="Dancing Sword";

				$t3_1="Fire Elemental";
				$t3_2="Flame Wave";
				$t3_3="Distortion";
				$t3_4="Meteorite";

            }
        	elseif ($_SESSION["charClass"]=="Sacerdotisa")
        	{

        		$src="imgs/skill/prs/";

				$t0_1="Healing";
				$t0_2="Holy Bolt";
				$t0_3="Multi Spark";
				$t0_4="Holy Mind";

				$t1_1="Meditation_";
				$t1_2="Divine Lightening";
				$t1_3="Holy Reflection";
				$t1_4="Grand Healing";

				$t2_1="Vigor Ball";
				$t2_2="Resurrection";
				$t2_3="Extinction";
				$t2_4="Virtual Life";

				$t3_1="Glacial Spike";
				$t3_2="Regen Field";
				$t3_3="Chain Lightening";
				$t3_4="Summon Muspell";

        	}
			elseif ($_SESSION["charClass"]=="Assassina")
            {

              $src="imgs/skill/ass/";

        $t0_1="<br>Ferrão<br>_";
        $t0_2="<br>Ataque<br> Duplo";
        $t0_3="<br>Maestria em<br> Adagas";
        $t0_4="<br>Wisp<br>_";

        $t1_1="<br>Trono de<br> Veneno";
        $t1_2="<br>Alas<br>_";
        $t1_3="<br>Choque na<br> Alma";
        $t1_4="<br>Maestria no<br> Ataque";

        $t2_1="<br>Adaga<br> Dolorida";
        $t2_2="<br>Espanca-<br> mento";
        $t2_3="<br>Inpes<br>_";
        $t2_4="<br>Sombria<br>_";

        $t3_1="<br>Vento<br> Gelado";
        $t3_2="<br>Maestria<br> Fatal";
        $t3_3="<br>Poluir<br> Sphere";
        $t3_4="<br>Sombra<br> Ninja";

        $t4_1="<br>Bombástica<br>_";
        $t4_2="<br>Golpe<br> Crescente";
        $t4_3="<br>Violência<br>_";
        $t4_4="<br>Tempestade<br>_";

            }
			elseif ($_SESSION["charClass"]=="Xama")
            {

              $src="imgs/skill/sha/";

        $t0_1="<br>Raio<br> Negro";
        $t0_2="<br>Onda<br> Negra";
        $t0_3="<br>Maldição<br> Prequiçosa";
        $t0_4="<br>Paz<br> Interior";

        $t1_1="<br>Labareda<br> Espiritual";
        $t1_2="<br>Algemador<br>_";
        $t1_3="<br>Caçada<br>_";
        $t1_4="<br>Advento<br> Migal";

        $t2_1="<br>Chuva<br>_";
        $t2_2="<br>Fantasma-<br> ria";
        $t2_3="<br>Assombrar<br>_";
        $t2_4="<br>Arranhar<br>_";

        $t3_1="<br>Chamar<br> Cavaleiro<br> Sanguinario";
        $t3_2="<br>Julgamento<br>_<br>_";
        $t3_3="<br>Advento<br> Midranda<br>_";
        $t3_4="<br>Manhã de<br> Oração<br>_";

        $t4_1="<br>Crença<br>_";
        $t4_2="<br>Força<br> Divina";
        $t4_3="<br>Prego<br> Fantasmagórico";
        $t4_4="<br>Vida<br> Divina";

            }
        	else
        	{$src="imgs/skill/";}

            if(anti_sqli($_POST[action]!="skill"))
            {
?>
            <form method="post" onSubmit="disabledBttn(this)" action="<?=$_SERVER[PHP_SELF]."?".$_SERVER[QUERY_STRING]?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="4" class="padding_all">
                  <tr>
                    <td><h5 class="title text-left"><span class="fa fa-angle-right"></span> 1&ordf; Tier</h5></td>
                  </tr>
                  <tr>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_01.jpg" width="39" height="39" align="middle">
                      <select name="tier0_1">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier0_1==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t0_1."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_02.jpg" width="39" height="39" align="middle">
                      <select name="tier0_2">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier0_2==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t0_2."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_03.jpg" width="39" height="39" align="middle">
                      <select name="tier0_3">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier0_3==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t0_3."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_04.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier0_4">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier0_4==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t0_4."</b>"?></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr/></td>
                  </tr>
                  <tr>
                    <td><h5 class="title text-left"><span class="fa fa-angle-right"></span> 2&ordf; Tier</h5></td>
                  </tr>
                  <tr>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_05.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier1_1">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier1_1==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t1_1."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_06.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier1_2">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier1_2==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t1_2."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_07.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier1_3">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier1_3==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t1_3."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_08.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier1_4">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier1_4==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t1_4."</b>"?></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr/></td>
                  </tr>
                  <tr>
                    <td><h5 class="title text-left"><span class="fa fa-angle-right"></span> 3&ordf; Tier</h5></td>
                  </tr>
                  <tr>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_09.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier2_1">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier2_1==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t2_1."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_10.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier2_2">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier2_2==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t2_2."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_11.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier2_3">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier2_3==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t2_3."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_12.jpg" width="39" height="39" align="absmiddle">
                      <select name="tier2_4">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier2_4==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t2_4."</b>"?></td>
                  </tr>
                  <tr>
                    <td colspan="4"><hr/></td>
                  </tr>
                  <tr>
                    <td><h5 class="title text-left"><span class="fa fa-angle-right"></span> 4&ordf; Tier</h5></td>
                  </tr>
                  <tr>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_13.jpg" width="39" height="40" align="absmiddle">
                      <select name="tier3_1">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier3_1==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t3_1."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_14.jpg" width="39" height="40" align="absmiddle">
                      <select name="tier3_2">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier3_2==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t3_2."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_15.jpg" width="39" height="40" align="absmiddle">
                      <select name="tier3_3">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier3_3==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t3_3."</b>"?></td>
                    <td><img src="imgs/skill/<?=$_SESSION["charClass"]?>_16.jpg" width="39" height="40" align="absmiddle">
                      <select name="tier3_4">
                      <?
                for($i=1; $i<=10; $i++)
                {
                    echo "<option ". ( ($tier3_4==$i)?"selected":"" ) .">". $i ."</option>";
                }
?>
                    </select><br>
                    <?echo "<b>".$t3_4."</b>"?></td>
                  </tr>
                </table></td>


<p> Pontos Simples :  <?=$defaultSP-$totalSP?> / Pontos Especiais : <?=$defaultEP-$totalEP?></p>

            <button value="submit" class="btn btn-default db" style="max-width: 20%;margin-left:10px;">Treinar Skills</button> 
            <input type="hidden" name="action" value="skill">
            </form>

<?
            }
            else
            {
                $checkSubmitSP=anti_sqli($_POST['tier0_1'])+anti_sqli($_POST['tier0_2'])+anti_sqli($_POST['tier0_3'])+anti_sqli($_POST['tier0_4'])+
            anti_sqli($_POST['tier1_1'])+anti_sqli($_POST['tier1_2'])+anti_sqli($_POST['tier1_3'])+anti_sqli($_POST['tier1_4'])+
            anti_sqli($_POST['tier2_1'])+anti_sqli($_POST['tier2_2'])+anti_sqli($_POST['tier2_3'])+anti_sqli($_POST['tier2_4']);

                $checkSubmitEP=anti_sqli($_POST['tier3_1'])+anti_sqli($_POST['tier3_2'])+anti_sqli($_POST['tier3_3'])+anti_sqli($_POST['tier3_4']);

                if( ($checkSubmitSP>$defaultSP) || ($checkSubmitEP>$defaultEP))
                {
                    echo "<p>Voc&ecirc; enviou uma SP (". $checkSubmitSP .") que &eacute; maior que a SP permitida  (". $defaultSP .") !</p";
                    echo "<p>Voc&ecirc; enviou uma EP (". $checkSubmitEP .") que &eacute; maior que a EP permitida  (". $defaultEP .") !</p>";
                }
                else
                {
                    $tier0_1=trim(pack("i",$_POST['tier0_1']),"\x00");
                    $tier0_2=trim(pack("i",$_POST['tier0_2']),"\x00");
                    $tier0_3=trim(pack("i",$_POST['tier0_3']),"\x00");
                    $tier0_4=trim(pack("i",$_POST['tier0_4']),"\x00");

                    $tier1_1=trim(pack("i",$_POST['tier1_1']),"\x00");
                    $tier1_2=trim(pack("i",$_POST['tier1_2']),"\x00");
                    $tier1_3=trim(pack("i",$_POST['tier1_3']),"\x00");
                    $tier1_4=trim(pack("i",$_POST['tier1_4']),"\x00");

                    $tier2_1=trim(pack("i",$_POST['tier2_1']),"\x00");
                    $tier2_2=trim(pack("i",$_POST['tier2_2']),"\x00");
                    $tier2_3=trim(pack("i",$_POST['tier2_3']),"\x00");
                    $tier2_4=trim(pack("i",$_POST['tier2_4']),"\x00");

                    $tier3_1=trim(pack("i",$_POST['tier3_1']),"\x00");
                    $tier3_2=trim(pack("i",$_POST['tier3_2']),"\x00");
                    $tier3_3=trim(pack("i",$_POST['tier3_3']),"\x00");
                    $tier3_4=trim(pack("i",$_POST['tier3_4']),"\x00");

                    $skillStr=$tier3_4.$tier0_1.$tier0_2.$tier0_3.$tier0_4.
                        $tier1_1.$tier1_2.$tier1_3.$tier1_4.
                        $tier2_1.$tier2_2.$tier2_3.$tier2_4.
                        $tier3_1.$tier3_2.$tier3_3;

                    $fRead=false;
                    $fOpen = fopen($_SESSION["charDir"], "r");
                    while (!feof($fOpen)) {
                    @$fRead = "$fRead" . fread($fOpen, filesize($_SESSION["charDir"]) );
                    }
                    fclose($fOpen);

                    $sourceStr = substr($fRead, 0, 508) . $skillStr . substr($fRead, 524, 0) . ($func->charFullMastery()) . substr($fRead, 564);
                    $fOpen = fopen($_SESSION["charDir"], "wb");
                    fwrite($fOpen, $sourceStr, strlen($sourceStr));
                    fclose($fOpen);

                    echo "<p>Pontos de Skills Atualizados com sucesso!</p>";

                }

                echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?sess=skill'>";
            }

        }

?>


