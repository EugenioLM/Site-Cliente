<?
include_once "anti_sql_injection.php";

function anti_sql($expressao)    {

    $inject=0;
  $expressao = strtolower($expressao);

    //arrays com palavras e caracteres invalidos
    $badword1 = array("' or 0=0 --",'" or 0=0 --',"or 0=0 --","' or 0=0 #","admin'--",'" or 0=0 #',"or 0=0 #","' or 'x'='x",'" or "x"="x',"') or ('x'='x","' or 1=1--",'" or 1=1--',"or 1=1--","' or a=a--",'" or "a"="a',"') or ('a'='a",'") or ("a"="a','hi" or "a"="a','hi" or 1=1 --',"hi' or 1=1 --","hi' or 'a'='a","hi') or ('a'='a",'hi") or ("a"="a',"or '1=1'");
    $badword2 = array("select", " select","select "," insert"," update","update "," delete","delete "," drop","drop "," destroy","destroy ");

    for($i=0;$i<sizeof($badword1);$i++) {
        if(substr_count($expressao,$badword1[$i])!=0)
          $inject=1;
       }

         for($i=0;$i<sizeof($badword2);$i++)    {
              if(substr_count($expressao,$badword2[$i])!=0)
              $inject=1;
         }

    $charvalidos = "abcdefghijklmnopqrstuvwxyz0123456789������������������������������������!?@#$%&(){}[]:;,.- _";

     for($i=0;$i<strlen($expressao);$i++)    {
        $char = substr($expressao,$i,1);
            if(substr_count($charvalidos,$char)==0)
               $inject=1;
         }

    return($inject);
}

function anti_sqlSuporte($expressao)    {

    $inject=0;
  $expressao = strtolower($expressao);

    //arrays com palavras e caracteres invalidos
    $badword1 = array("' or 0=0 --",'" or 0=0 --',"or 0=0 --","' or 0=0 #","admin'--",'" or 0=0 #',"or 0=0 #","' or 'x'='x",'" or "x"="x',"') or ('x'='x","' or 1=1--",'" or 1=1--',"or 1=1--","' or a=a--",'" or "a"="a',"') or ('a'='a",'") or ("a"="a','hi" or "a"="a','hi" or 1=1 --',"hi' or 1=1 --","hi' or 'a'='a","hi') or ('a'='a",'hi") or ("a"="a',"or '1=1'");
    $badword2 = array("select", " select","select "," insert"," update","update "," delete","delete "," drop","drop "," destroy","destroy ");

    for($i=0;$i<sizeof($badword1);$i++) {
        if(substr_count($expressao,$badword1[$i])!=0)
          $inject=1;
       }

         for($i=0;$i<sizeof($badword2);$i++)    {
              if(substr_count($expressao,$badword2[$i])!=0)
              $inject=1;
         }

    $charvalidos = "abcdefghijklmnopqrstuvwxyz0123456789������������������������������������!?@#$%&(){}[]:;,.- _+/";

     for($i=0;$i<strlen($expressao);$i++)    {
        $char = substr($expressao,$i,1);
            if(substr_count($charvalidos,$char)==0)
               $inject=1;
         }

    return($inject);
}


function anti_sqlSuporteTXT($expressao)    {

    $inject=0;
  $expressao = strtolower($expressao);

    //arrays com palavras e caracteres invalidos
    $badword1 = array("' or 0=0 --",'" or 0=0 --',"or 0=0 --","' or 0=0 #","admin'--",'" or 0=0 #',"or 0=0 #","' or 'x'='x",'" or "x"="x',"') or ('x'='x","' or 1=1--",'" or 1=1--',"or 1=1--","' or a=a--",'" or "a"="a',"') or ('a'='a",'") or ("a"="a','hi" or "a"="a','hi" or 1=1 --',"hi' or 1=1 --","hi' or 'a'='a","hi') or ('a'='a",'hi") or ("a"="a',"or '1=1'");
    $badword2 = array("select", " select","select "," insert"," update","update "," delete","delete "," drop","drop "," destroy","destroy ");

    for($i=0;$i<sizeof($badword1);$i++) {
        if(substr_count($expressao,$badword1[$i])!=0)
          $inject=1;
       }

         for($i=0;$i<sizeof($badword2);$i++)    {
              if(substr_count($expressao,$badword2[$i])!=0)
              $inject=1;
         }

    $charvalidos = "abcdefghijklmnopqrstuvwxyz0123456789������������������������������������!?@#$%&(){}[]:;,.- _+/= ";

     for($i=0;$i<strlen($expressao);$i++)    {
        $char = substr($expressao,$i,1);
            if(substr_count($charvalidos,$char)==0)
               $inject=1;
         }

    return($inject);
}


function nUm($name) { $character=array ( "!"=>"33", "\""=>"34", "#"=>"35", "$"=>"36", "%"=>"37", "&"=>"38", "'"=>"39", "("=>"40", ")"=>"41", "*"=>"42", "+"=>"43", ","=>"44", "-"=>"45", "."=>"46", "/"=>"47", "0"=>"48", "1"=>"49", "2"=>"50", "3"=>"51", "4"=>"52", "5"=>"53", "6"=>"54", "7"=>"55", "8"=>"56", "9"=>"57", ":"=>"58", ";"=>"59", "<"=>"60", "="=>"61", ">"=>"62", "?"=>"63", "@"=>"64", "A"=>"65", "B"=>"66", "C"=>"67", "D"=>"68", "E"=>"69", "F"=>"70", "G"=>"71", "H"=>"72", "I"=>"73", "J"=>"74", "K"=>"75", "L"=>"76", "M"=>"77", "N"=>"78", "O"=>"79", "P"=>"80", "Q"=>"81", "R"=>"82", "S"=>"83", "T"=>"84", "U"=>"85", "V"=>"86", "W"=>"87", "X"=>"88", "Y"=>"89", "Z"=>"90", "["=>"91", "\\"=>"92", "]"=>"93", "^"=>"94", "_"=>"95", "`"=>"96", "a"=>"65", "b"=>"66", "c"=>"67", "d"=>"68", "e"=>"69", "f"=>"70", "g"=>"71", "h"=>"72", "i"=>"73", "j"=>"74", "k"=>"75", "l"=>"76", "m"=>"77", "n"=>"78", "o"=>"79", "p"=>"80", "q"=>"81", "r"=>"82", "s"=>"83", "t"=>"84", "u"=>"85", "v"=>"86", "w"=>"87", "x"=>"88", "y"=>"89", "z"=>"90", "{"=>"123", "|"=>"124", "}"=>"125", "~"=>"126", ""=>"127", "�"=>"128", "�"=>"129", "�"=>"130", "�"=>"131", "�"=>"132", "�"=>"133", "�"=>"134", "�"=>"135", "�"=>"136", "�"=>"137", "�"=>"138", "�"=>"139", "�"=>"140", "�"=>"141", "�"=>"142", "�"=>"143", "�"=>"144", "�"=>"145", "�"=>"146", "�"=>"147", "�"=>"148", "�"=>"149", "�"=>"150", "�"=>"151", "�"=>"152", "�"=>"153", "�"=>"154", "�"=>"155", "�"=>"156", "�"=>"157", "�"=>"158", "�"=>"159", "�"=>"161", "�"=>"162", "�"=>"163", "�"=>"164", "�"=>"165", "�"=>"166", "�"=>"167", "�"=>"168", "�"=>"169", "�"=>"170", "�"=>"171", "�"=>"172", "�"=>"173", "�"=>"174", "�"=>"175", "�"=>"176", "�"=>"177", "�"=>"178", "�"=>"179", "�"=>"180", "�"=>"181", "�"=>"182", "�"=>"183", "�"=>"184", "�"=>"185", "�"=>"186", "�"=>"187", "�"=>"188", "�"=>"189", "�"=>"190", "�"=>"191", "�"=>"192", "�"=>"193", "�"=>"194", "�"=>"195", "�"=>"196", "�"=>"197", "�"=>"198", "�"=>"199", "�"=>"200", "�"=>"201", "�"=>"202", "�"=>"203", "�"=>"204", "�"=>"205", "�"=>"206", "�"=>"207", "�"=>"208", "�"=>"209", "�"=>"210", "�"=>"211", "�"=>"212", "�"=>"213", "�"=>"214", "�"=>"215", "�"=>"216", "�"=>"217", "�"=>"218", "�"=>"219", "�"=>"220", "�"=>"221", "�"=>"222", "�"=>"223", "�"=>"224", "�"=>"225", "�"=>"226", "�"=>"227", "�"=>"228", "�"=>"229", "�"=>"230", "�"=>"231", "�"=>"232", "�"=>"233", "�"=>"234", "�"=>"235", "�"=>"236", "�"=>"237", "�"=>"238", "�"=>"239", "�"=>"240", "�"=>"241", "�"=>"242", "�"=>"243", "�"=>"244", "�"=>"245", "�"=>"246", "�"=>"247", "�"=>"248", "�"=>"249", "�"=>"250", "�"=>"251", "�"=>"252", "�"=>"253", "�"=>"254", "�"=>"255", );  for($i=0;$i<strlen($name);$i++) { $total+=$character[$name[$i]]; if($total>=256) $total=$total-256; }  return $total; }
?>